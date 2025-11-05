<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ThermoWatch') - Monitoreo Industrial</title>

    {{-- 🛠️ Variables de Tema (Basadas en tu manifest) --}}
    <style>
        :root {
            --primary-color: #37474F;
            /* Gris/Azul Oscuro Industrial */
            --secondary-color: #FF5733;
            /* Rojo/Naranja de Alerta */
            --data-color: #1E88E5;
            /* Azul de Datos */
            --bg-color: #ECEFF1;
            /* Fondo claro PWA */
        }

        /* Estilos mínimos para evitar FOUC y asegurar coherencia */
        body {
            background-color: var(--bg-color);
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px;
        }
    </style>

    {{-- ✅ Estilos esenciales de la App Shell --}}
    <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/authloginregister.css') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" href="{{ asset('icons/icon-192x192.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- ✅ Registro del Service Worker (PWA) --}}
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('{{ asset('ServiceWorker.js') }}')
                    .then(reg => console.log('[SW] Activo en:', reg.scope))
                    .catch(err => console.error('[SW] Error:', err));
            });
        }
    </script>

    {{-- Estilos específicos por vista (ej. si una vista hereda) --}}
    @yield('styles')
</head>

<body>
    <div class="app">

        {{-- Contenido principal de la vista heredada --}}
        <main>
            @yield('content')
        </main>

        {{-- FOOTER Mínimo de la Shell --}}
        <footer>
            <div class="container" style="text-align: center; color: #546E7A; padding: 15px; font-size: 0.8rem;">
                ThermoWatch — Monitoreo de Maquinaria
            </div>
        </footer>
    </div>
</body>

</html>