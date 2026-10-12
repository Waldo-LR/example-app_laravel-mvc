<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'      => 'sometimes|required|string|max:100',
            'descripcion' => 'sometimes|required|string',
            'precio'      => 'sometimes|required|numeric|min:0|max:999999.99',
        ];
    }
}