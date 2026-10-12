<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-100 p-6" x-data="{ 
    modalCrear: false, 
    modalVer: false, 
    modalEditar: false,
    modalEliminar: false,
    proveedorSeleccionado: {},
    proveedorEdit: {},
    proveedorDelete: {}
}">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Lista de Proveedores</h1>
            <button @click="modalCrear = true" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                + Nuevo Proveedor
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

        {{-- Tabla de Proveedores --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="p-3 border-b">ID</th>
                        <th class="p-3 border-b">RUC</th>
                        <th class="p-3 border-b">Razón Social</th>
                        <th class="p-3 border-b">Teléfono</th>
                        <th class="p-3 border-b">Email</th>
                        <th class="p-3 border-b">Estado</th>
                        <th class="p-3 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($proveedores as $proveedor)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="p-3 font-semibold text-gray-700">{{ $proveedor->id }}</td>
                            <td class="p-3 font-mono text-sm text-blue-600 font-semibold">{{ $proveedor->ruc }}</td>
                            <td class="p-3 font-medium text-gray-900">{{ $proveedor->razon_social }}</td>
                            <td class="p-3 text-gray-600">{{ $proveedor->telefono ?? 'N/A' }}</td>
                            <td class="p-3 text-gray-600">{{ $proveedor->email ?? 'N/A' }}</td>
                            <td class="p-3">
                                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $proveedor->estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $proveedor->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button @click="proveedorSeleccionado = {{ json_encode($proveedor) }}; modalVer = true" class="bg-gray-500 hover:bg-gray-600 text-white text-sm px-3 py-1 rounded">
                                        Ver
                                    </button>
                                    <button @click="proveedorEdit = {{ json_encode($proveedor) }}; modalEditar = true" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1 rounded">
                                        Editar
                                    </button>
                                    <button @click="proveedorDelete = {{ json_encode($proveedor) }}; modalEliminar = true" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center p-4 text-gray-500">No se encontraron proveedores registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (method_exists($proveedores, 'links'))
            <div class="mt-4">{{ $proveedores->links() }}</div>
        @endif
    </div>

    <!-- MODAL: NUEVO PROVEEDOR -->
    <div x-show="modalCrear" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6" @click.away="modalCrear = false">
            <h2 class="text-xl font-bold mb-4">Registrar Nuevo Proveedor</h2>
            <form action="{{ route('proveedores.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">RUC (11 dígitos)</label>
                    <input type="text" name="ruc" required maxlength="11" class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Razón Social</label>
                    <input type="text" name="razon_social" required maxlength="150" class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" maxlength="15" class="mt-1 block w-full rounded-md border p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" maxlength="100" class="mt-1 block w-full rounded-md border p-2">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="direccion" maxlength="200" class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="estado" class="mt-1 block w-full rounded-md border p-2">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="modalCrear = false" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: VER PROVEEDOR -->
    <div x-show="modalVer" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6" @click.away="modalVer = false">
            <h2 class="text-xl font-bold mb-4">Detalle del Proveedor #<span x-text="proveedorSeleccionado.id"></span></h2>
            <div class="space-y-3">
                <p><strong>RUC:</strong> <span x-text="proveedorSeleccionado.ruc" class="font-mono text-blue-600"></span></p>
                <p><strong>Razón Social:</strong> <span x-text="proveedorSeleccionado.razon_social"></span></p>
                <p><strong>Teléfono:</strong> <span x-text="proveedorSeleccionado.telefono || 'N/A'"></span></p>
                <p><strong>Email:</strong> <span x-text="proveedorSeleccionado.email || 'N/A'"></span></p>
                <p><strong>Dirección:</strong> <span x-text="proveedorSeleccionado.direccion || 'N/A'"></span></p>
                <p><strong>Estado:</strong> <span x-text="proveedorSeleccionado.estado ? 'Activo' : 'Inactivo'"></span></p>
            </div>
            <div class="flex justify-end pt-4 border-t mt-4">
                <button type="button" @click="modalVer = false" class="bg-gray-500 text-white px-4 py-2 rounded">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- MODAL: EDITAR PROVEEDOR -->
    <div x-show="modalEditar" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6" @click.away="modalEditar = false">
            <h2 class="text-xl font-bold mb-4">Editar Proveedor #<span x-text="proveedorEdit.id"></span></h2>
            
            <form :action="'{{ url('proveedores') }}/' + proveedorEdit.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700">RUC (11 dígitos)</label>
                    <input type="text" name="ruc" x-model="proveedorEdit.ruc" required maxlength="11" class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Razón Social</label>
                    <input type="text" name="razon_social" x-model="proveedorEdit.razon_social" required class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" x-model="proveedorEdit.telefono" class="mt-1 block w-full rounded-md border p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" x-model="proveedorEdit.email" class="mt-1 block w-full rounded-md border p-2">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="direccion" x-model="proveedorEdit.direccion" class="mt-1 block w-full rounded-md border p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="estado" x-model="proveedorEdit.estado" class="mt-1 block w-full rounded-md border p-2">
                        <option :value="1">Activo</option>
                        <option :value="0">Inactivo</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" @click="modalEditar = false" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- MODAL: ELIMINAR PROVEEDOR -->
    <div x-show="modalEliminar" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 text-center" @click.away="modalEliminar = false">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Confirmar Eliminación</h3>
            <p class="text-sm text-gray-500 mb-6">
                ¿Estás seguro de que deseas eliminar al proveedor <strong class="text-gray-800" x-text="proveedorDelete.razon_social"></strong>? Esta acción no se puede deshacer.
            </p>
            <form :action="'/proveedores/' + proveedorDelete.id" method="POST" class="flex justify-center space-x-3">
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