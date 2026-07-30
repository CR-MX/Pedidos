<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OficinaEmisoraSeeder extends Seeder
{
    public function run(): void
    {
        $lugares = [
            ['nombre' => 'Jardin Juarez'],
            ['nombre' => 'Plaza futura'],
            ['nombre' => 'Mercado Soriana'],
        ];

        DB::table('lugares')->insert($lugares);
    }
}