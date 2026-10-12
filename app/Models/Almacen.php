<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $table = 'almacenes';

    protected $fillable = [
        'nombre_almacen',
        'dirección',
        'tamanio',
        'estado',
    ];

    protected $casts = [
        'tamanio' => 'float',
        'estado' => 'boolean',
    ];
}
