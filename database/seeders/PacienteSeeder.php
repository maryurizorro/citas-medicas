<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        $pacientes = [
            [
                'nombre' => 'Pedro',
                'apellido' => 'González',
                'email' => 'pedro.gonzalez@email.com',
                'telefono' => '555-0101',
            ],
            [
                'nombre' => 'Laura',
                'apellido' => 'Fernández',
                'email' => 'laura.fernandez@email.com',
                'telefono' => '555-0102',
            ],
            [
                'nombre' => 'Roberto',
                'apellido' => 'Sánchez',
                'email' => 'roberto.sanchez@email.com',
                'telefono' => '555-0103',
            ],
            [
                'nombre' => 'Carmen',
                'apellido' => 'Díaz',
                'email' => 'carmen.diaz@email.com',
                'telefono' => '555-0104',
            ],
        ];

        foreach ($pacientes as $paciente) {
            Paciente::create($paciente);
        }
    }
}

