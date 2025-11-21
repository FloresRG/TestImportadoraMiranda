<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class GenerarQrResponseDto extends Data
{
    public function __construct(
        public int $Codigo,
        public ?GenerarQrDataDto $Data,
        public string $Mensaje
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Codigo: $data['Codigo'],
            Data: isset($data['Data']) ? GenerarQrDataDto::fromArray($data['Data']) : null,
            Mensaje: $data['Mensaje']
        );
    }
}

class GenerarQrDataDto extends Data
{
    public function __construct(
        public int $movimiento_id,
        public string $qr
    ) {}

    public static function fromArray(array $data): self
    {
        return new self($data['movimiento_id'], $data['qr']);
    }
}