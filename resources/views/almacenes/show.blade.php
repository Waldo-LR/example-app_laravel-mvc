<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Almacén</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Detalles del Almacén #{{ $almacen->id }}</h1>
            <a href="{{ route('almacenes.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded text-sm transition">
                ← Volver a la Lista
            </a>
        </div>

        <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-md">
                <p class="text-xs text-gray-500 uppercase font-bold">Nombre del Almacén</p>
                <p class="text-lg font-medium text-gray-800">{{ $almacen->nombre_almacen }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-md">
                <p class="text-xs text-gray-500 uppercase font-bold">Dirección</p>
                <p class="text-md text-gray-800">{{ $almacen->dirección }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-md">
                    <p class="text-xs text-gray-500 uppercase font-bold">Tamaño</p>
                    <p class="text-md font-semibold text-gray-800">{{ number_format($almacen->tamanio, 2) }} m²</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-md">
                    <p class="text-xs text-gray-500 uppercase font-bold">Estado</p>
                    <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full {{ $almacen->estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $almacen->estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 text-xs text-gray-500 border-t pt-4">
                <p><strong>Fecha de Creación:</strong> {{ $almacen->created_at ? $almacen->created_at->format('d/m/Y H:i') : 'N/A' }}</p>
                <p><strong>Última Actualización:</strong> {{ $almacen->updated_at ? $almacen->updated_at->format('d/m/Y H:i') : 'N/A' }}</p>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
            <a href="{{ route('almacenes.edit', $almacen->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded transition">
                Editar Almacén
            </a>
        </div>
    </div>
</body>
</html>