<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Listar todas las especialidades
     */
    public function index()
    {
        return response()->json(Especialidad::all(), 200);
    }

    /**
     * Crear una nueva especialidad
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        $especialidad = Especialidad::create($validated);

        return response()->json($especialidad, 201);
    }

    /**
     * Mostrar una especialidad por ID
     */
    public function show(string $id)
    {
        $especialidad = Especialidad::findOrFail($id);
        return response()->json($especialidad, 200);
    }

    /**
     * Actualizar una especialidad
     */
    public function update(Request $request, string $id)
    {
        $especialidad = Especialidad::findOrFail($id);

        $validated = $request->validate([
            'nombre'      => 'sometimes|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        $especialidad->update($validated);

        return response()->json($especialidad, 200);
    }

    /**
     * Eliminar una especialidad
     */
    public function destroy(string $id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();

        return response()->json(['message' => 'Especialidad eliminada correctamente'], 200);
    }

    /**
     * Consulta: Médicos por especialidad
     */
    public function medicosPorEspecialidad(string $id)
    {
        $especialidad = Especialidad::with('medicos')->findOrFail($id);

        return response()->json([
            'especialidad' => $especialidad->nombre,
            'medicos' => $especialidad->medicos
        ], 200);
    }

    
}
