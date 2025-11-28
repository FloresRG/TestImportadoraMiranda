<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VerificacionController extends Controller
{
    // 1. Solo muestra la vista
    public function index()
    {
        return view('verificacion.index');
    }

    // 2. Devuelve las últimas 20 ventas con sus productos y los totales del día
    public function validar()
    {
        $hoy = \Carbon\Carbon::today();

        $ventas = Venta::with(['ventaProductos.producto', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get()
            ->map(function ($venta) {
                $venta->cambio = $venta->pagado - ($venta->efectivo + $venta->qr);
                return $venta;
            });

        $totalEfectivo = Venta::whereDate('fecha', $hoy)
            ->where('estado', 'NORMAL')
            ->where('tipo_pago', 'Efectivo')
            ->sum('costo_total') +
            Venta::whereDate('fecha', $hoy)
            ->where('estado', 'NORMAL')
            ->where('tipo_pago', 'Efectivo y QR')
            ->sum('efectivo');

        $totalQr = Venta::whereDate('fecha', $hoy)
            ->where('estado', 'NORMAL')
            ->where('tipo_pago', 'QR')
            ->sum('costo_total') +
            Venta::whereDate('fecha', $hoy)
            ->where('estado', 'NORMAL')
            ->where('tipo_pago', 'Efectivo y QR')
            ->sum('qr');

        return response()->json([
            'ventas' => $ventas,
            'totales' => [
                'efectivo' => $totalEfectivo,
                'qr' => $totalQr,
            ]
        ]);
    }
}
