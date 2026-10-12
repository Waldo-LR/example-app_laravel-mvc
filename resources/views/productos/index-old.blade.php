@extends('layouts.layout')

@section('contenido')
    <div class="grid grid-cols-6 gap-3">

        <div class="col-span-2">
    <h1 class="text-3xl font-bold text-white">
    Lista de Productos</h1>

    <p class="text-yellow-300 italic">Bienvenido a la página de productos.</p>

        <div class="mt-5">
            <a href="{{ route('productos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Guardar Producto
            </a>

            <input type="text" placeholder="Nombre.." class="border border-gray-300 rounded py-2 px-4 w-full mt-3 hover:bg-white hover:text-black">
            
            <input type="text" placeholder="Descripciòn..." class="border border-gray-300 rounded py-2 px-4 w-full mt-3 hover:bg-white hover:text-black">

            <input type="text" placeholder="Precio..." class="border border-gray-300 rounded py-2 px-4 w-full mt-3 hover:bg-white hover:text-black">

        </div>
</div>

<div class="col-span-4">
    <table class="table-auto w-full border border-gray-100 rounded-lg shadow-md">
        <thead class="text-white bg-gray-950 bg-opacity-25 p-4">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->precio }}</td>
                </tr>
            @endforeach 
        </tbody>
    </table>
    </div>
    </div>
@endsection