<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Relacionar secretarias existentes con datos extra en 'secretarias'
        DB::table('secretarias')->insert([
            [
                'user_id' => 1, // id de secretaria1 en users
                'telefono' => '3213',
                'direccion' => 'Calle 14 Horizonte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // id de secretaria2 en users
                'telefono' => '313425',
                'direccion' => 'Carrera 7 Norte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


