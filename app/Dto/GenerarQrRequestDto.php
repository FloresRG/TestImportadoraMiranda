<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class GenerarQrRequestDto extends Data
{
    public function __construct(
        public string $secret_key,
        public float $monto,
        public ?array $data = null,
        public ?string $vigencia = null,
        public ?bool $uso_unico = null,
        public ?string $detalle = null,
    ) {}
}