<?php

namespace Database\Seeders;

use App\Models\Cita;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $citas = [
            [
                'paciente_id' => 1,
                'medico_id' => 1,
                'fecha' => now()->addDays(2)->setTime(10, 0),
                'estado' => 'pendiente',
                'observaciones' => 'Primera consulta cardiológica',
            ],
            [
                'paciente_id' => 2,
                'medico_id' => 2,
                'fecha' => now()->addDays(3)->setTime(14, 30),
                'estado' => 'confirmada',
                'observaciones' => 'Revisión de dermatitis',
            ],
            [
                'paciente_id' => 3,
                'medico_id' => 3,
                'fecha' => now()->addDays(1)->setTime(9, 0),
                'estado' => 'pendiente',
                'observaciones' => 'Dolor en rodilla derecha',
            ],
            [
                'paciente_id' => 4,
                'medico_id' => 4,
                'fecha' => now()->addDays(5)->setTime(11, 0),
                'estado' => 'confirmada',
                'observaciones' => 'Control pediátrico anual',
            ],
        ];

        foreach ($citas as $cita) {
            Cita::create($cita);
        }
    }
}

