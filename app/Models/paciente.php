<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'email',
        'telefono',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'estado',
    ];

    // Casting de atributos
    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];
}
