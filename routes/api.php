<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController as ApiProductoController;
use App\Http\Controllers\Api\AlmacenController as ApiAlmacenController;
use App\Http\Controllers\Api\ProveedorController as ApiProveedorController;

// Asignamos el prefijo 'api.' a los nombres de las rutas

Route::name('api.')->group(function () {
    Route::apiResource('productos', ApiProductoController::class)->parameters(['productos' => 'producto']);

    Route::apiResource('almacenes', ApiAlmacenController::class)->parameters(['almacenes' => 'almacen']);

    Route::apiResource('proveedores', ApiProveedorController::class)->parameters(['proveedores' => 'proveedor']);
});