<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OficinaEmisoraSeeder extends Seeder
{
    public function run(): void
    {
        $oficinas = [
            ['nombre' => 'Culiacán'],
            ['nombre' => 'Mazatlán'],
            ['nombre' => 'Los Mochis'],
            ['nombre' => 'Guasave'],
            ['nombre' => 'Escuinapa'],
        ];

        DB::table('oficinas_emisoras')->insert($oficinas);
    }
}