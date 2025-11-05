<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThermoWatch - Acceso de Trabajadores</title>
    <link rel="stylesheet" href="{{ asset('styles/authloginregister.css') }}">
</head>

<body>
    <div class="auth-card">
        <div class="auth-header">
            <span class="text-3xl">🔥</span>
            <h2>Ingreso de Trabajadores a ThermoWatch</h2>
        </div>

        @if (session('status'))
            <p class="text-danger">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="input-group">
                <label for="correo">Correo Electrónico</label>
                <input id="correo" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username" placeholder="tu.correo@thermowatch.com" />
                @error('email') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="••••••••" />
                @error('password') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <label for="remember_me" style="font-size: 0.9rem; color: #555;">
                    <input id="remember_me" type="checkbox" name="remember" style="width: auto; margin-right: 5px;">
                    Recordarme
                </label>

                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}" style="font-size: 0.9rem;">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-primary">
                Ingresar al Panel
            </button>
        </form>

        <p style="text-align: center; margin-top: 25px; font-size: 0.9rem; color: #555;">
            ¿No tienes cuenta?
            <a class="auth-link" href="{{ route('register') }}">Regístrate aquí</a>
        </p>

        <a class="btn-secondary" href="{{ route('index') }}">
            ← Volver a la Landing Page
        </a>
    </div>
</body>

</html>