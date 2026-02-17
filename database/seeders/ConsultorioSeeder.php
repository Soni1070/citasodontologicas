<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consultorio;

class ConsultorioSeeder extends Seeder
{
    public function run(): void
    {
        Consultorio::firstOrCreate(
            ['nombre' => 'Consultorio General'],
            [
                'ubicacion' => 'Planta baja',
                'capacidad' => '1 paciente',
                'telefono' => '5551234567',
                'especialidad' => 'Odontología general',
                'estado' => 'activo',
            ]
        );

        Consultorio::firstOrCreate(
            ['nombre' => 'Consultorio Ortodoncia'],
            [
                'ubicacion' => 'Primer piso',
                'capacidad' => '1 paciente',
                'telefono' => null,
                'especialidad' => 'Ortodoncia',
                'estado' => 'activo',
            ]
        );
    }
}
