<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="p-4 container bg-amber-100 mx-auto" >
    <section class="bg-gray-100 p-4 text-center">
    <h1 class="text-3xl font-bold underline text-red-400">
      Esto es una tabla de datos del sistema
    </h1>
    </section>

    <table class="table-auto border-collapse border border-slate-500 w-full">
        <thead class="bg-gray-200 font-bold">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
        </thead>
        <tbody class="bg-white py-3 text-sm">
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->created_at }}</td>
                    <td>{{ $usuario->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>