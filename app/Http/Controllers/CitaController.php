<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Listar todas las citas con paciente y médico
     */
    public function index()
    {
        $citas = Cita::with(['paciente', 'medico.especialidad'])->get();
        return response()->json($citas, 200);
    }

    /**
     * Crear una nueva cita
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paciente_id'   => 'required|exists:pacientes,id',
            'medico_id'     => 'required|exists:medicos,id',
            'fecha'         => 'required|date_format:Y-m-d H:i:s',
            'estado'        => 'in:pendiente,confirmada,cancelada',
            'observaciones' => 'nullable|string',
        ]);

        $cita = Cita::create($validated);

        return response()->json($cita->load(['paciente', 'medico.especialidad']), 201);
    }

    /**
     * Mostrar una cita por ID
     */
    public function show(string $id)
    {
        $cita = Cita::with(['paciente', 'medico.especialidad'])->findOrFail($id);
        return response()->json($cita, 200);
    }

    /**
     * Actualizar una cita
     */
    public function update(Request $request, string $id)
    {
        $cita = Cita::findOrFail($id);

        $validated = $request->validate([
            'paciente_id'   => 'sometimes|exists:pacientes,id',
            'medico_id'     => 'sometimes|exists:medicos,id',
            'fecha'         => 'sometimes|date_format:Y-m-d H:i:s',
            'estado'        => 'in:pendiente,confirmada,cancelada',
            'observaciones' => 'nullable|string',
        ]);

        $cita->update($validated);

        return response()->json($cita->load(['paciente', 'medico.especialidad']), 200);
    }

    /**
     * Eliminar una cita
     */
    public function destroy(string $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return response()->json(['message' => 'Cita eliminada correctamente'], 200);
    }

    /**
     * Listar citas por paciente
     */
    public function citasPorPaciente(string $paciente_id)
    {
        $citas = Cita::with(['medico.especialidad'])
            ->where('paciente_id', $paciente_id)
            ->get();

        return response()->json($citas, 200);
    }

    /**
     * Listar citas por médico
     */
    public function citasPorMedico(string $medico_id)
    {
        $citas = Cita::with(['paciente'])
            ->where('medico_id', $medico_id)
            ->get();

        return response()->json($citas, 200);
    }

    /**
     * Listar citas por estado (pendiente, confirmada o cancelada)
     */
    public function citasPorEstado(string $estado)
    {
        $citas = Cita::with(['paciente', 'medico.especialidad'])
            ->where('estado', $estado)
            ->get();

        return response()->json($citas, 200);
    }
}
