<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CitaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Usuarios
Route::get('usuarios', [UsuarioController::class, 'index']);//✅
Route::post('usuarios', [UsuarioController::class, 'store']);//✅
Route::get('usuarios/{id}', [UsuarioController::class, 'show']);//✅
Route::put('usuarios/{id}', [UsuarioController::class, 'update']);//✅
Route::delete('usuarios/{id}', [UsuarioController::class, 'destroy']);//✅

// Pacientes
Route::get('pacientes', [PacienteController::class, 'index']);//✅
Route::post('pacientes', [PacienteController::class, 'store']);//✅
Route::get('pacientes/{id}', [PacienteController::class, 'show']);//✅
Route::put('pacientes/{id}', [PacienteController::class, 'update']);//✅
Route::delete('pacientes/{id}', [PacienteController::class, 'destroy']);//✅

// Especialidades
Route::get('especialidades', [EspecialidadController::class, 'index']);//✅
Route::post('especialidades', [EspecialidadController::class, 'store']);//✅
Route::get('especialidades/{id}', [EspecialidadController::class, 'show']);//✅
Route::put('especialidades/{id}', [EspecialidadController::class, 'update']);//✅
Route::delete('especialidades/{id}', [EspecialidadController::class, 'destroy']);//✅

// Médicos
Route::get('medicos', [MedicoController::class, 'index']);//✅
Route::post('medicos', [MedicoController::class, 'store']);//✅
Route::get('medicos/{id}', [MedicoController::class, 'show']);//✅
Route::put('medicos/{id}', [MedicoController::class, 'update']);//✅
Route::delete('medicos/{id}', [MedicoController::class, 'destroy']);//✅

// Citas
Route::get('citas', [CitaController::class, 'index']);//✅
Route::post('citas', [CitaController::class, 'store']);//✅
Route::get('citas/{id}', [CitaController::class, 'show']);//✅
Route::put('citas/{id}', [CitaController::class, 'update']);//✅
Route::delete('citas/{id}', [CitaController::class, 'destroy']);//✅
