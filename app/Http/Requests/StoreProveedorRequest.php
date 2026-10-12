<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ruc'          => 'required|string|size:11|unique:proveedores,ruc',
            'razon_social' => 'required|string|max:150',
            'telefono'     => 'nullable|string|max:15',
            'email'        => 'nullable|email|max:100',
            'direccion'    => 'nullable|string|max:200',
            'estado'       => 'boolean',
        ];
    }
}
