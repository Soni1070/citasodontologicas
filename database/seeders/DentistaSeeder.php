<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dentista;
use Illuminate\Support\Facades\Hash;

class DentistaSeeder extends Seeder
{
    public function run(): void
    {
        $dentistas = [
            [
                'email' => 'dentista1@admin.com',
                'name' => 'Dentista Uno',
                'nombres' => 'Juan',
                'apellidos' => 'Pérez',
                'registro' => 'REG-001',
                'especialidad' => 'Odontología General',
                'telefono' => '5551111111',
            ],
            [
                'email' => 'dentista2@admin.com',
                'name' => 'Dentista Dos',
                'nombres' => 'Ana',
                'apellidos' => 'Gómez',
                'registro' => 'REG-002',
                'especialidad' => 'Ortodoncia',
                'telefono' => '5552222222',
            ],
        ];

        foreach ($dentistas as $d) {
            $user = User::firstOrCreate(
                ['email' => $d['email']],
                [
                    'name' => $d['name'],
                    'password' => Hash::make('clave123'),
                ]
            );

            $user->assignRole('dentista');

            Dentista::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nombres' => $d['nombres'],
                    'apellidos' => $d['apellidos'],
                    'registro_medico' => $d['registro'],
                    'especialidad' => $d['especialidad'],
                    'telefono' => $d['telefono'],
                    'estado' => 'activo',
                ]
            );
        }
    }
}
