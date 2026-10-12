<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Almacen;
use App\Http\Requests\StoreAlmacenRequest;
use App\Http\Requests\UpdateAlmacenRequest;

class AlmacenController extends Controller
{
    public function index()
    {
        return response()->json(Almacen::all(), 200);
    }

    public function store(StoreAlmacenRequest $request)
    {
        $almacen = Almacen::create($request->validated());
        return response()->json([
            'message' => 'Almacén creado exitosamente',
            'data' => $almacen
        ], 201);
    }

    public function show(Almacen $almacen)
    {
        return response()->json($almacen, 200);
    }

    public function update(UpdateAlmacenRequest $request, Almacen $almacen)
    {
        $almacen->update($request->validated());
        return response()->json([
            'message' => 'Almacén actualizado exitosamente',
            'data' => $almacen
        ], 200);
    }

    public function destroy(Almacen $almacen)
    {
        $almacen->delete();
        return response()->json([
            'message' => 'Almacén eliminado exitosamente'
        ], 200);
    }
}