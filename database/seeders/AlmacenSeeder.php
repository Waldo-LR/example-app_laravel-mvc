<?php

namespace Database\Seeders;

use App\Models\Almacen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class AlmacenSeeder extends Seeder
{
    public function run(): void
    {
        Almacen::factory(25)->create();
    }
}
