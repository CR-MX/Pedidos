<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colores = [
            'Rojo',
            'Azul',
            'Verde',
            'Amarillo',
            'Negro',
            'Blanco',
            'Gris',
            'Naranja',
            'Rosa',
            'Morado',
        ];

        foreach ($colores as $nombre) {
            Color::create(compact('nombre'));
        }
    }
}
