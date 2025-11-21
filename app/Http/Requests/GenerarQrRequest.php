<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerarQrRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'monto' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function monto(): float
    {
        return (float) $this->validated('monto');
    }
}