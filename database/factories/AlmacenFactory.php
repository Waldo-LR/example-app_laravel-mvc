<?php

namespace Database\Factories;

use App\Models\Almacen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Almacen>
 */
class AlmacenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre_almacen' => 'Almacén ' . fake()->city(),
            'dirección'      => fake()->address(),
            'tamanio'        => fake()->randomFloat(2, 50, 2000),
            'estado'         => fake()->boolean(80), // 80% probabilidad de estar activo
        ];
    }
}