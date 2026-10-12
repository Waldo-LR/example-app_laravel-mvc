<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Detalles del Producto #{{ $producto->id }}</h1>
            <a href="{{ route('productos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded text-sm transition">
                ← Volver a la Lista
            </a>
        </div>

        <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-md">
                <p class="text-xs text-gray-500 uppercase font-bold">Nombre</p>
                <p class="text-lg font-semibold text-gray-800">{{ $producto->nombre }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-md">
                <p class="text-xs text-gray-500 uppercase font-bold">Descripción</p>
                <p class="text-md text-gray-700 whitespace-pre-line">{{ $producto->descripcion }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-md">
                <p class="text-xs text-gray-500 uppercase font-bold">Precio</p>
                <p class="text-xl font-bold text-green-600">S/ {{ number_format($producto->precio, 2) }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-xs text-gray-500 border-t pt-4">
                <p><strong>Fecha de Creación:</strong> {{ $producto->created_at ? $producto->created_at->format('d/m/Y H:i') : 'N/A' }}</p>
                <p><strong>Última Actualización:</strong> {{ $producto->updated_at ? $producto->updated_at->format('d/m/Y H:i') : 'N/A' }}</p>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
            <a href="{{ route('productos.edit', $producto->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded transition">
                Editar Producto
            </a>
        </div>
    </div>
</body>
</html>