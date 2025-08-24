<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relación ejemplo con Médicos (si más adelante un médico pertenece a una especialidad)
    // public function medicos()
    // {
    //     return $this->hasMany(Medico::class, 'especialidad_id');
    // }
}
