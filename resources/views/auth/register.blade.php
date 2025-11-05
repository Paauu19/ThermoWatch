<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThermoWatch - Registro de Personal</title>
    <link rel="stylesheet" href="{{ asset('styles/authloginregister.css') }}">
</head>

<body>
    <div class="auth-card">
        <div class="auth-header">
            <span class="text-3xl">👷</span>
            <h2>Registro de Nuevo Personal</h2>
        </div>

        <form method="POST" action="{{ route('register.post') }}" id="registerForm">
            @csrf

            <div class="input-group">
                <label for="nombre">Nombre Completo</label>
                <input id="nombre" type="text" name="name" value="{{ old('name') }}" required autofocus
                    autocomplete="name" placeholder="Nombre y Apellido del Trabajador" />
                @error('name') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="correo">Correo Electrónico</label>
                <input id="correo" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    placeholder="tu.correo@thermowatch.com" />
                @error('email') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            {{-- CAMPO CLAVE PARA EL ROL DEL TRABAJADOR --}}
            <div class="input-group">
                <label for="role">Rol en ThermoWatch</label>
                <select id="role" name="role" required>
                    <option value="operador" selected>Operador (Monitoreo)</option>
                    <option value="administrador">Administrador (Gestión y Configuración)</option>
                </select>
                @error('role') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="contraseña">Contraseña</label>
                <input id="contraseña" type="password" name="password" required autocomplete="new-password"
                    placeholder="••••••••" />
                @error('password') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" placeholder="••••••••" />
                @error('password_confirmation') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="password-checklist">
                <p style="font-weight: 600; margin-bottom: 5px;">Tu contraseña debe contener:</p>
                <ul>
                    <li id="checkLength">❌ Al menos 8 caracteres</li>
                    <li id="checkUpper">❌ Una letra mayúscula</li>
                    <li id="checkNumber">❌ Un número</li>
                    <li id="checkSpecial">❌ Un carácter especial (!@#$%^&*)</li>
                </ul>
            </div>

            <button type="submit" class="btn-primary">
                Registrar
            </button>
        </form>

        <p style="text-align: center; margin-top: 25px; font-size: 0.9rem; color: #555;">
            <a class="auth-link" href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión aquí</a>
        </p>

        <a class="btn-secondary" href="{{ route('index') }}">
            ← Volver a la Landing Page
        </a>
    </div>

    <script>
        // Lógica de validación de contraseña en tiempo real se mantiene
        const passwordInput = document.getElementById("contraseña");
        const checkLength = document.getElementById("checkLength");
        const checkUpper = document.getElementById("checkUpper");
        const checkNumber = document.getElementById("checkNumber");
        const checkSpecial = document.getElementById("checkSpecial");

        passwordInput.addEventListener("input", () => {
            const pwd = passwordInput.value;

            const updateCheck = (element, condition, text) => {
                const emoji = condition ? "✅" : "❌";
                element.textContent = `${emoji} ${text}`;
                element.style.color = condition ? 'green' : '#999';
            };

            updateCheck(checkLength, pwd.length >= 8, "Al menos 8 caracteres");
            updateCheck(checkUpper, /[A-Z]/.test(pwd), "Una letra mayúscula");
            updateCheck(checkNumber, /[0-9]/.test(pwd), "Un número");
            updateCheck(checkSpecial, /[!@#$%^&*]/.test(pwd), "Un carácter especial (!@#$%^&*)");
        });
    </script>
</body>

</html>