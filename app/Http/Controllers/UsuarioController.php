<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Listar todos los usuarios
     */
    public function index()
    {
        return response()->json(Usuario::all(), 200);
    }

    /**
     * Crear un nuevo usuario
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'rol'      => 'in:admin,paciente,medico',
        ]);

        // Encriptar password antes de guardar
        $validated['password'] = Hash::make($validated['password']);

        $usuario = Usuario::create($validated);

        return response()->json($usuario, 201);
    }

    /**
     * Mostrar un usuario por ID
     */
    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario, 200);
    }

    /**
     * Actualizar un usuario
     */
    public function update(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $validated = $request->validate([
            'nombre'   => 'sometimes|string|max:100',
            'email'    => 'sometimes|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:6',
            'rol'      => 'in:admin,paciente,medico',
        ]);

        // Si actualiza la contraseña, la encriptamos
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $usuario->update($validated);

        return response()->json($usuario, 200);
    }

    /**
     * Eliminar un usuario
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
