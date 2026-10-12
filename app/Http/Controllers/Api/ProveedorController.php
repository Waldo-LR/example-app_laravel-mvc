<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;

class ProveedorController extends Controller
{
    public function index()
    {
        return response()->json(Proveedor::all(), 200);
    }

    public function store(StoreProveedorRequest $request)
    {
        $proveedor = Proveedor::create($request->validated());
        return response()->json([
            'message' => 'Proveedor registrado exitosamente',
            'data' => $proveedor
        ], 201);
    }

    public function show(Proveedor $proveedor)
    {
        return response()->json($proveedor, 200);
    }

    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        $proveedor->update($request->validated());
        return response()->json([
            'message' => 'Proveedor actualizado exitosamente',
            'data' => $proveedor
        ], 200);
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return response()->json([
            'message' => 'Proveedor eliminado exitosamente'
        ], 200);
    }
}