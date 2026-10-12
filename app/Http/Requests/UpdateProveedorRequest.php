<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el objeto o ID del proveedor desde la ruta
        $proveedor = $this->route('proveedor');
        $proveedorId = is_object($proveedor) ? $proveedor->id : $proveedor;

        return [
            'ruc' => [
                'sometimes',
                'required',
                'string',
                'size:11',
                Rule::unique('proveedores', 'ruc')->ignore($proveedorId),
            ],
            'razon_social' => 'sometimes|required|string|max:150',
            'telefono'     => 'nullable|string|max:15',
            'email'        => 'nullable|email|max:100',
            'direccion'    => 'nullable|string|max:200',
            'estado'       => 'boolean',
        ];
    }
}