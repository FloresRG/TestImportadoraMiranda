<?php

namespace App\Services;

use App\Dto\GenerarQrRequestDto;
use App\Dto\GenerarQrResponseDto;
use App\Dto\VerificarQrResponseDto;
use Illuminate\Support\Facades\Http;

class VeripagosService
{
    public function __construct(
        private readonly string $baseUrl = 'https://veripagos.com/api/bcp'
    ) {}

    public function generarQr(GenerarQrRequestDto $dto): GenerarQrResponseDto
    {
        $response = Http::withBasicAuth(
            config('veripagos.username'),
            config('veripagos.password')
        )->post("{$this->baseUrl}/generar-qr", $dto->toArray());

        return GenerarQrResponseDto::fromArray($response->json());
    }

    public function verificarQr(string $secretKey, string $movimientoId): VerificarQrResponseDto
    {
        $response = Http::withBasicAuth(
            config('veripagos.username'),
            config('veripagos.password')
        )->post("{$this->baseUrl}/verificar-estado-qr", [
            'secret_key' => $secretKey,
            'movimiento_id' => $movimientoId,
        ]);

        return VerificarQrResponseDto::fromArray($response->json());
    }
}