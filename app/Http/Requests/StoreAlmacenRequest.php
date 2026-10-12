<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAlmacenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_almacen' => 'required|string|max:100',
            'dirección'      => 'required|string|max:200',
            'tamanio'        => 'required|numeric|min:0|max:9999.99',
            'estado'         => 'boolean',
        ];
    }
}