<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        $categorias = ['Oficina', 'Tecnología', 'Hogar', 'Cómputo', 'Electrónica', 'Accesorios', 'Seguridad'];
        $materiales = ['Inalámbrico', 'Premium', 'Portátil', 'Digital', 'Multifunción', 'Ergonómico', 'Pro'];
        
        $categoria = fake()->randomElement($categorias);
        $material  = fake()->randomElement($materiales);
        $color     = ucfirst(fake()->colorName());

        return [
            'nombre'      => "Producto {$categoria} {$color} {$material}",
            'descripcion' => "Artículo para {$categoria} en excelente estado. Fabricado con materiales de alta calidad y garantía local.",
            'precio'      => fake()->randomFloat(2, 10, 1500),
        ];
    }
}