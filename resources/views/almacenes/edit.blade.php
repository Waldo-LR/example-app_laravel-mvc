<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Almacén</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Editar Almacén #{{ $almacen->id }}</h1>
            <a href="{{ route('almacenes.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded text-sm transition">
                ← Volver a la Lista
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Ocurrieron errores en el formulario:</p>
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('almacenes.update', $almacen->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nombre_almacen" class="block text-sm font-medium text-gray-700">Nombre del Almacén</label>
                <input type="text" name="nombre_almacen" id="nombre_almacen" value="{{ old('nombre_almacen', $almacen->nombre_almacen) }}" required maxlength="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="dirección" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="dirección" id="dirección" value="{{ old('dirección', $almacen->dirección) }}" required maxlength="200" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="tamanio" class="block text-sm font-medium text-gray-700">Tamaño (m²)</label>
                <input type="number" step="0.01" name="tamanio" id="tamanio" value="{{ old('tamanio', $almacen->tamanio) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                    <option value="1" {{ old('estado', $almacen->estado) ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ !old('estado', $almacen->estado) ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="{{ route('almacenes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded transition">
                    Actualizar Almacén
                </button>
            </div>
        </form>
    </div>
</body>
</html>