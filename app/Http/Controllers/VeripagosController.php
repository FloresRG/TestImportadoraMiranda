<?php

namespace App\Http\Controllers;

use App\Dto\GenerarQrRequestDto;
use App\Http\Requests\GenerarQrRequest;
use App\Http\Requests\VerificarQrRequest;
use App\Services\VeripagosService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VeripagosController extends Controller
{
    public function __construct(private VeripagosService $veripagos) {}

    public function showForm(): \Illuminate\Contracts\View\View
    {
        return view('veripagos.form');
    }

    public function generarQr(GenerarQrRequest $request): JsonResponse
    {
        $dto = new GenerarQrRequestDto(
            secret_key: config('veripagos.secret_key'),
            monto: $request->monto(),
            vigencia: '0/00:05',
            uso_unico: true,
            detalle: 'Pago tienda',
            data: ['pedido_id' => uniqid()]
        );

        $response = $this->veripagos->generarQr($dto);
        return response()->json($response);
    }

    public function verificarQr(VerificarQrRequest $request): JsonResponse
    {
        $response = $this->veripagos->verificarQr(
            config('veripagos.secret_key'),
            $request->movimientoId()
        );
        return response()->json($response);
    }

    public function webhook(Request $request): JsonResponse
    {
        // Validar Basic Auth (como antes)
        $auth = $request->header('Authorization');
        if (!$auth || !str_starts_with($auth, 'Basic ')) abort(401);
        [$user, $pass] = explode(':', base64_decode(substr($auth, 6)), 2);
        if ($user !== config('veripagos.username') || $pass !== config('veripagos.password')) abort(401);

        // Validar estructura del webhook
        $payload = $request->validate([
            'movimiento_id' => 'required|integer',
            'monto'         => 'required|numeric',
            'estado'        => 'required|string',
            'data'          => 'array',
            'remitente'     => 'required|array',
            'remitente.nombre'   => 'required|string',
            'remitente.banco'    => 'required|string',
            'remitente.documento' => 'required|string',
            'remitente.cuenta'   => 'required|string',
        ]);

        Log::info('✅ Webhook Veripagos recibido', $payload);
        
        return response()->json(['ok' => true]);
    }
}