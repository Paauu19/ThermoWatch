<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ... (Métodos index, consultaUsuarios, create se mantienen igual) ...


    /**
     * Guarda un nuevo usuario.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 🚨 CORRECCIÓN: Usar los nuevos roles temáticos
            'role' => ['required', 'string', Rule::in(['administrador', 'operador'])],
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
            'email_verified_at' => now(),
        ]);

        return redirect()->route('administracion.usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    // ... (Método edit se mantiene igual) ...

    /**
     * Actualiza un usuario.
     */
    public function update(Request $request, User $usuario): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            // 🚨 CORRECCIÓN: Usar los nuevos roles temáticos (y eliminar 'user')
            'role' => ['required', 'string', Rule::in(['administrador', 'operador'])],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
        ];

        if (!empty($validatedData['password'])) {
            $data['password'] = Hash::make($validatedData['password']);
        }

        $usuario->update($data);

        // 🚨 CORRECCIÓN: Asegurar que la redirección usa la ruta correcta 'administracion.usuarios.index'
// (Asumo que admin.index no existe o es incorrecto)
        return redirect()->route('administracion.usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    // ... (Método destroy se mantiene igual) ...
}