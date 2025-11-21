<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class VerificarQrResponseDto extends Data
{
    public function __construct(
        public int $Codigo,
        public ?VerificarQrDataDto $Data,
        public string $Mensaje
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Codigo: $data['Codigo'],
            Data: isset($data['Data']) ? VerificarQrDataDto::fromArray($data['Data']) : null,
            Mensaje: $data['Mensaje']
        );
    }
}

class VerificarQrDataDto extends Data
{
    public function __construct(
        public int $movimiento_id,
        public float $monto,
        public string $detalle,
        public string $estado,
        public string $estado_notificacion,
        public RemitenteDto $remitente
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            movimiento_id: $data['movimiento_id'],
            monto: $data['monto'],
            detalle: $data['detalle'],
            estado: $data['estado'],
            estado_notificacion: $data['estado_notificacion'],
            remitente: RemitenteDto::fromArray($data['remitente'])
        );
    }
}

class RemitenteDto extends Data
{
    public function __construct(
        public string $nombre,
        public string $banco,
        public string $documento,
        public string $cuenta
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            nombre: $data['nombre'],
            banco: $data['banco'],
            documento: $data['documento'],
            cuenta: $data['cuenta']
        );
    }
}