<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
  
    public function index()
    {
        return response()->json(Medico::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellido'     => 'required|string|max:100',
            'especialidad' => 'required|string|max:100',
            'email'        => 'required|email|unique:medicos,email',
        ]);

        $medico = Medico::create($validated);
        return response()->json($medico, 201);
    }

  
    public function show(string $id)
    {
        $medico = Medico::findOrFail($id);
        return response()->json($medico, 200);
    }

    
    public function update(Request $request, string $id)
    {
        $medico = Medico::findOrFail($id);

        $validated = $request->validate([
            'nombre'       => 'sometimes|string|max:100',
            'apellido'     => 'sometimes|string|max:100',
            'especialidad' => 'sometimes|string|max:100',
            'email'        => 'sometimes|email|unique:medicos,email,' . $medico->id,
        ]);

        $medico->update($validated);

        return response()->json($medico, 200);
    }

    public function destroy(string $id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return response()->json(['message' => 'Médico eliminado correctamente'], 200);
    }

 
    public function medicosPorEspecialidad(string $especialidad)
    {
        $medicos = Medico::where('especialidad', $especialidad)->get();
        return response()->json($medicos, 200);
    }
}
