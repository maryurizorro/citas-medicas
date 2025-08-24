<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Listar todos los pacientes
     */
    public function index()
    {
        return response()->json(Paciente::all(), 200);
    }

    /**
     * Crear un nuevo paciente
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'required|string|max:100',
            'documento'        => 'required|string|unique:pacientes,documento',
            'email'            => 'required|email|unique:pacientes,email',
            'telefono'         => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'genero'           => 'nullable|in:masculino,femenino,otro',
            'direccion'        => 'nullable|string',
            'estado'           => 'in:activo,inactivo',
        ]);

        $paciente = Paciente::create($validated);

        return response()->json($paciente, 201);
    }

    /**
     * Mostrar un paciente por ID
     */
    public function show(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        return response()->json($paciente, 200);
    }

    /**
     * Actualizar un paciente
     */
    public function update(Request $request, string $id)
    {
        $paciente = Paciente::findOrFail($id);

        $validated = $request->validate([
            'nombre'           => 'sometimes|string|max:100',
            'apellido'         => 'sometimes|string|max:100',
            'documento'        => 'sometimes|string|unique:pacientes,documento,' . $paciente->id,
            'email'            => 'sometimes|email|unique:pacientes,email,' . $paciente->id,
            'telefono'         => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'genero'           => 'nullable|in:masculino,femenino,otro',
            'direccion'        => 'nullable|string',
            'estado'           => 'in:activo,inactivo',
        ]);

        $paciente->update($validated);

        return response()->json($paciente, 200);
    }

    /**
     * Eliminar un paciente
     */
    public function destroy(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return response()->json(['message' => 'Paciente eliminado correctamente'], 200);
    }

  
    public function pacientesPorMedico(string $medico_id)
    {
        $pacientes = Paciente::whereHas('citas', function($query) use ($medico_id) {
            $query->where('medico_id', $medico_id);
        })->get();

        return response()->json($pacientes, 200);
    }
//(consulta añadida)
   
    public function pacientesActivos()
    {
        $pacientes = Paciente::where('estado', 'activo')->get();
        return response()->json($pacientes, 200);
    }
}
