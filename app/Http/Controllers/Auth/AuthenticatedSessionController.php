<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\AppServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra la vista de login (GET /login).
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Procesa la solicitud de autenticación (POST /login).
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // 🔑 PASO CLAVE: RESTRICCIÓN DE ROL DESPUÉS DE LA AUTENTICACIÓN
            $user = Auth::user();
            $roles_permitidos = ['administrador', 'operador'];

            if (!in_array($user->role, $roles_permitidos)) {
                // Si el rol no es autorizado, cerramos la sesión forzosamente
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Acceso denegado: Este login es solo para personal de ThermoWatch (Administrador u Operador).',
                ])->onlyInput('email');
            }
            // FIN DE RESTRICCIÓN

            $request->session()->regenerate();

            // ✅ CORRECCIÓN CLAVE: Redirigir usando la constante HOME (AppServiceProvider::HOME)
            return redirect()->intended(AppServiceProvider::HOME);
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión (POST /logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}