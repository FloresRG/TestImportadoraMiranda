<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VeripagosController extends Controller
{
    private string $baseUrl = 'https://veripagos.com/api/bcp';

    public function showForm()
    {
        return view('veripagos.form');
    }

    public function generarQr(Request $request)
    {
        $request->validate(['monto' => 'required|numeric|min:0.01']);

        $secretKey = config('veripagos.secret_key');
        $username = config('veripagos.username');
        $password = config('veripagos.password');

        if (!$secretKey || !$username || !$password) {
            Log::error('Veripagos: credenciales no configuradas');
            return response()->json(['Codigo' => 1, 'Mensaje' => 'Error interno: credenciales no configuradas'], 500);
        }

        $pedidoId = 'pedido_' . now()->timestamp . '_' . rand(1000, 9999);
        Log::info('Generando QR', ['pedido_id' => $pedidoId, 'monto' => $request->monto]);

        try {
            $response = Http::withBasicAuth($username, $password)
                ->timeout(30)
                ->post("{$this->baseUrl}/generar-qr", [
                    'secret_key' => $secretKey,
                    'monto' => (float) $request->monto,
                    'data' => ['pedido_id' => $pedidoId],
                    'vigencia' => '0/00:10',
                    'uso_unico' => true,
                    'detalle' => 'Pago Importadora Miranda',
                ]);

            $data = $response->json();

            if ($data['Codigo'] === 0) {
                Cache::put("pago_{$pedidoId}_estado", 'pendiente', now()->addMinutes(10));
                Log::info('QR generado', ['movimiento_id' => $data['Data']['movimiento_id'], 'pedido_id' => $pedidoId]);
                $data['pedido_id'] = $pedidoId; // ← ¡clave para sincronizar con frontend!
            }

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error al generar QR', ['exception' => $e->getMessage()]);
            return response()->json(['Codigo' => 1, 'Mensaje' => 'Error al conectar con Veripagos'], 500);
        }
    }

    public function webhook(Request $request)
    {
        $auth = $request->header('Authorization');
        if (!$auth || !str_starts_with($auth, 'Basic ')) {
            return response('Unauthorized', 401);
        }

        $credentials = base64_decode(substr($auth, 6));
        if (!$credentials || !str_contains($credentials, ':')) {
            return response('Unauthorized', 401);
        }

        [$user, $pass] = explode(':', $credentials, 2);
        if ($user !== config('veripagos.username') || $pass !== config('veripagos.password')) {
            Log::warning('Webhook: credenciales inválidas');
            return response('Unauthorized', 401);
        }

        $payload = $request->validate([
            'movimiento_id' => 'required|integer',
            'monto' => 'required|numeric',
            'estado' => 'required|string',
            'data' => 'array',
            'remitente' => 'required|array',
        ]);

        Log::info('✅ Webhook Veripagos recibido', $payload);

        $pedidoId = $payload['data']['pedido_id'] ?? null;
        if ($pedidoId && $payload['estado'] === 'Completado') {
            Cache::put("pago_{$pedidoId}_estado", 'completado', now()->addMinutes(5));
            Log::info("✅ Estado actualizado en caché para {$pedidoId}");
        }

        return response()->json(['ok' => true]);
    }

    public function streamPagoEstado(string $pedidoId)
    {
        if (!Cache::has("pago_{$pedidoId}_estado")) {
            Cache::put("pago_{$pedidoId}_estado", 'pendiente', now()->addMinutes(10));
        }

        return response()->stream(function () use ($pedidoId) {
            echo "event: connected\n";
            echo 'data: {"msg":"SSE conectado"}' . "\n\n";
            ob_flush(); flush();

            $timeout = now()->addMinutes(2);
            while (now()->lessThan($timeout)) {
                if (connection_aborted()) break;

                $estado = Cache::get("pago_{$pedidoId}_estado");
                if ($estado === 'completado') {
                    echo "event: pago_completado\n";
                    echo 'data: {"estado":"completado","mensaje":"¡Pago confirmado!"}' . "\n\n";
                    ob_flush(); flush();
                    break;
                }

                sleep(1);
            }

            if (!connection_aborted()) {
                echo "event: timeout\n";
                echo 'data: {"msg":"timeout"}' . "\n\n";
                ob_flush(); flush();
            }
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
            'X-Accel-Buffering' => 'no',
        ]);
    }
}