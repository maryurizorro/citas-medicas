<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Para autenticación
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
    ];

    // Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación ejemplo con Paciente (si un usuario con rol paciente está vinculado)
    // public function paciente()
    // {
    //     return $this->hasOne(Paciente::class, 'usuario_id');
    // }
}
