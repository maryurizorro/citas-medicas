<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido',
        'especialidad_id',
        'email',
        'telefono',
        'licencia_medica',
        'estado',
    ];

    /**
     * Relación con Especialidad
     */
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    // Relación ejemplo con Citas (si lo usas más adelante)
    // public function citas()
    // {
    //     return $this->hasMany(Cita::class, 'medico_id');
    // }
}
