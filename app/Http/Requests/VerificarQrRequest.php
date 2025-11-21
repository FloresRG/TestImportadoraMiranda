<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerificarQrRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'movimiento_id' => ['required', 'string'],
        ];
    }

    public function movimientoId(): string
    {
        return (string) $this->validated('movimiento_id');
    }
}