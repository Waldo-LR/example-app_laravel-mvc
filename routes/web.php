<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ProveedorController;

Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index'); 

// Rutas Web para las vistas Blade
Route::resource('productos', ProductoController::class)->parameters(['productos' => 'producto']);
Route::resource('almacenes', AlmacenController::class)->parameters(['almacenes' => 'almacen']);
Route::resource('proveedores', ProveedorController::class)->parameters(['proveedores' => 'proveedor']);