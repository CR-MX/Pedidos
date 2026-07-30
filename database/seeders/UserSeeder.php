<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Carlos',
            'email' => 'carlos@gmail.com',
            'password' => bcrypt('Carlos1234'),
        ]);

        User::create([
            'name' => 'Divergetica',
            'email' => 'divergetica@gmail.com',
            'password' => bcrypt('divergetica1234'),
        ]);

       
        
    }
}