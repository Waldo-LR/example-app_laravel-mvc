<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Proveedor>
 */
class ProveedorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ruc'          => '20' . fake()->unique()->numerify('#########'),
            'razon_social' => fake()->company() . ' ' . fake()->companySuffix(),
            'telefono'     => '9' . fake()->numerify('########'),
            'email'        => fake()->companyEmail(),
            'direccion'    => fake()->address(),
            'estado'       => fake()->boolean(85), // 85% activos
        ];
    }
}
