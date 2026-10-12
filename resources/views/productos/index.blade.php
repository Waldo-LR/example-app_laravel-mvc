<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-100 p-6" x-data="{ 
    modalCrear: false, 
    modalVer: false, 
    modalEditar: false,
    modalEliminar: false,
    productoSeleccionado: {},
    productoEdit: {},
    productoDelete: {}
}">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Lista de Productos</h1>
            <button @click="modalCrear = true" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                + Nuevo Producto
            </button>
        </div>

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Errores de Validación --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Por favor corrige los errores:</p>
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Tabla de Productos --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="p-3 border-b">ID</th>
                        <th class="p-3 border-b">Nombre</th>
                        <th class="p-3 border-b">Descripción</th>
                        <th class="p-3 border-b">Precio</th>
                        <th class="p-3 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="p-3 font-semibold text-gray-700">{{ $producto->id }}</td>
                            <td class="p-3 font-medium text-gray-900">{{ $producto->nombre }}</td>
                            <td class="p-3 text-gray-600 max-w-xs truncate">{{ $producto->descripcion }}</td>
                            <td class="p-3 font-semibold text-gray-800">S/ {{ number_format($producto->precio, 2) }}</td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    {{-- Botón Ver --}}
                                    <button @click="productoSeleccionado = {{ json_encode($producto) }}; modalVer = true" class="bg-gray-500 hover:bg-gray-600 text-white text-sm px-3 py-1 rounded">
                                        Ver
                                    </button>

                                    {{-- Botón Editar --}}
                                    <button @click="productoEdit = {{ json_encode($producto) }}; modalEditar = true" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1 rounded">
                                        Editar
                                    </button>

                                    {{-- Botón Eliminar (Abre Modal Flotante de Confirmación) --}}
                                    <button @click="productoDelete = {{ json_encode($producto) }}; modalEliminar = true" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">No se encontraron productos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (method_exists($productos, 'links'))
            <div class="mt-4">{{ $productos->links() }}</div>
        @endif
    </div>

    <!-- MODAL: NUEVO PRODUCTO -->
    <div x-show="modalCrear" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6" @click.away="modalCrear = false">
            <h2 class="text-xl font-bold mb-4">Registrar Nuevo Producto</h2>
            <form action="{{ route('productos.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                    <input type="text" name="nombre" required maxlength="100" class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="descripcion" rows="3" required class="mt-1 block w-full rounded-md border p-2"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio (S/)</label>
                    <input type="number" step="0.01" name="precio" required class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="modalCrear = false" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: VER PRODUCTO -->
    <div x-show="modalVer" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6" @click.away="modalVer = false">
            <h2 class="text-xl font-bold mb-4">Detalle del Producto #<span x-text="productoSeleccionado.id"></span></h2>
            <div class="space-y-3">
                <p><strong>Nombre:</strong> <span x-text="productoSeleccionado.nombre"></span></p>
                <p><strong>Descripción:</strong> <span x-text="productoSeleccionado.descripcion"></span></p>
                <p><strong>Precio:</strong> S/ <span x-text="parseFloat(productoSeleccionado.precio).toFixed(2)"></span></p>
            </div>
            <div class="flex justify-end pt-4 border-t mt-4">
                <button type="button" @click="modalVer = false" class="bg-gray-500 text-white px-4 py-2 rounded">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- MODAL: EDITAR PRODUCTO -->
    <div x-show="modalEditar" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6" @click.away="modalEditar = false">
            <h2 class="text-xl font-bold mb-4">Editar Producto #<span x-text="productoEdit.id"></span></h2>
            <form :action="'/productos/' + productoEdit.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                    <input type="text" name="nombre" x-model="productoEdit.nombre" required class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="descripcion" x-model="productoEdit.descripcion" rows="3" required class="mt-1 block w-full rounded-md border p-2"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio (S/)</label>
                    <input type="number" step="0.01" name="precio" x-model="productoEdit.precio" required class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="modalEditar = false" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: ELIMINAR PRODUCTO -->
    <div x-show="modalEliminar" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 text-center" @click.away="modalEliminar = false">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Confirmar Eliminación</h3>
            <p class="text-sm text-gray-500 mb-6">
                ¿Estás seguro de que deseas eliminar el producto <strong class="text-gray-800" x-text="productoDelete.nombre"></strong>? Esta acción no se puede deshacer.
            </p>
            <form :action="'/productos/' + productoDelete.id" method="POST" class="flex justify-center space-x-3">
                @csrf
                @method('DELETE')
                <button type="button" @click="modalEliminar = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded font-medium transition">
                    Cancelar
                </button>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-medium transition">
                    Sí, Eliminar
                </button>
            </form>
        </div>
    </div>
</body>
</html>