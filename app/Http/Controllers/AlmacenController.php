<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Http\Requests\StoreAlmacenRequest;
use App\Http\Requests\UpdateAlmacenRequest;

class AlmacenController extends Controller
{
    public function index()
    {
        $almacenes = Almacen::paginate(10);
        return view('almacenes.index', compact('almacenes'));
    }

    public function create()
    {
        return view('almacenes.create');
    }

    public function store(StoreAlmacenRequest $request)
    {
        Almacen::create($request->validated());
        return redirect()->route('almacenes.index')->with('success', 'Almacén creado con éxito.');
    }

    public function show(Almacen $almacen)
    {
        return view('almacenes.show', compact('almacen'));
    }

    public function edit(Almacen $almacen)
    {
        return view('almacenes.edit', compact('almacen'));
    }

    public function update(UpdateAlmacenRequest $request, Almacen $almacen)
    {
        $almacen->update($request->validated());
        return redirect()->route('almacenes.index')->with('success', 'Almacén actualizado con éxito.');
    }

    public function destroy(Almacen $almacen)
    {
        $almacen->delete();
        return redirect()->route('almacenes.index')->with('success', 'Almacén eliminado con éxito.');
    }
}