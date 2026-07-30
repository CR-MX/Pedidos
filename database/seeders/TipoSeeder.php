<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Nombre Lapiz'],
            ['nombre' => 'Llavero'],
        ];

        DB::table('tipos')->insert($tipos);
    }
}