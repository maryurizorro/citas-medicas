<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Listar todos los médicos con su especialidad
     */
    public function index()
    {
        $medicos = Medico::with('especialidad')->get();
        return response()->json($medicos, 200);
    }

    /**
     * Crear un nuevo médico
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'          => 'required|string|max:100',
            'apellido'        => 'required|string|max:100',
            'especialidad_id' => 'required|exists:especialidades,id',
            'email'           => 'required|email|unique:medicos,email',
            'telefono'        => 'nullable|string|max:20',
            'licencia_medica' => 'required|string|unique:medicos,licencia_medica',
            'estado'          => 'in:activo,inactivo',
        ]);

        $medico = Medico::create($validated);

        return response()->json($medico->load('especialidad'), 201);
    }

    /**
     * Mostrar un médico por ID
     */
    public function show(string $id)
    {
        $medico = Medico::with('especialidad')->findOrFail($id);
        return response()->json($medico, 200);
    }

    /**
     * Actualizar un médico
     */
    public function update(Request $request, string $id)
    {
        $medico = Medico::findOrFail($id);

        $validated = $request->validate([
            'nombre'          => 'sometimes|string|max:100',
            'apellido'        => 'sometimes|string|max:100',
            'especialidad_id' => 'sometimes|exists:especialidades,id',
            'email'           => 'sometimes|email|unique:medicos,email,' . $medico->id,
            'telefono'        => 'nullable|string|max:20',
            'licencia_medica' => 'sometimes|string|unique:medicos,licencia_medica,' . $medico->id,
            'estado'          => 'in:activo,inactivo',
        ]);

        $medico->update($validated);

        return response()->json($medico->load('especialidad'), 200);
    }

    /**
     * Eliminar un médico
     */
    public function destroy(string $id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return response()->json(['message' => 'Médico eliminado correctamente'], 200);
    }
}
