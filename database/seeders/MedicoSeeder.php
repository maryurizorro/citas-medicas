<?php

namespace Database\Seeders;

use App\Models\Medico;
use Illuminate\Database\Seeder;

class MedicoSeeder extends Seeder
{
    public function run(): void
    {
        $medicos = [
            [
                'nombre' => 'Dr. Juan',
                'apellido' => 'García',
                'especialidad' => 'Cardiología',
                'email' => 'juan.garcia@hospital.com',
            ],
            [
                'nombre' => 'Dra. María',
                'apellido' => 'López',
                'especialidad' => 'Dermatología',
                'email' => 'maria.lopez@hospital.com',
            ],
            [
                'nombre' => 'Dr. Carlos',
                'apellido' => 'Rodríguez',
                'especialidad' => 'Ortopedia',
                'email' => 'carlos.rodriguez@hospital.com',
            ],
            [
                'nombre' => 'Dra. Ana',
                'apellido' => 'Martínez',
                'especialidad' => 'Pediatría',
                'email' => 'ana.martinez@hospital.com',
            ],
        ];

        foreach ($medicos as $medico) {
            Medico::create($medico);
        }
    }
}

