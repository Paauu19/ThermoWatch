<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThermoWatch - Monitoreo Industrial de Temperatura</title>

    {{-- Adaptación de PWA y Estilos --}}
    <meta name="theme-color" content="#37474F" /> {{-- Usamos el color principal oscuro de tu manifest --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Registro del Service Worker (Fundamental para el modo offline) --}}
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                // Asegúrate de que tu service worker se llama 'ServiceWorker.js'
                navigator.serviceWorker.register('{{ asset('ServiceWorker.js') }}')
                    .then(reg => console.log('[SW] registrado en:', reg.scope))
                    .catch(err => console.error('[SW] error:', err));
            });
        }
    </script>
</head>

<body>
    {{-- 🔥 HEADER FUNCIONAL (Usa el estilo oscuro de styles.css) --}}
    <header class="header">
        <div class="header-container">
            <h1>ThermoWatch</h1>
            <nav class="nav-links">
                <a href="{{ route('index') }}">Inicio</a>
                <a href="#beneficios">Beneficios</a>
                <a href="#tecnologia">Tecnología</a>
                <a href="#contacto">Contacto</a>

                @auth
                    {{-- Usuario AUTENTICADO: Botón de Dashboard y Salir --}}
                    {{-- Usamos btn-dashboard para el estilo azul de operaciones --}}
                    <a href="{{ route('welcome') }}" class="btn-dashboard"><i class="fas fa-chart-line"></i> Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        {{-- Usamos btn-logout para el estilo rojo de alerta/salida --}}
                        <button type="submit" class="btn-logout">Salir</button>
                    </form>
                @else
                    {{-- Usuario NO AUTENTICADO: Botones de Entrar y Registro --}}
                    <a href="{{ route('login') }}" class="btn-login"><i class="fas fa-sign-in-alt"></i> Entrar</a>
                    <a href="{{ route('register') }}" class="hero-btn--secondary">Registro</a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- 🌡️ HERO PRINCIPAL --}}
    <section class="hero hero--industrial" id="inicio" style="
        /*
            Asegura que el fondo industrial se cargue, es clave para el tema.
            Si no usas la URL de Unsplash, usa una imagen local en public/img/fondo_industrial.jpg
        */
        background-image: url('{{ asset('img/fondo_industrial.jpg') }}');
    ">
        <div class="hero-visual-overlay"></div>
        <div class="hero-content">
            <h2 class="hero-title">Monitoreo Industrial Inteligente</h2>
            <p class="hero-subtitle">
                ThermoWatch previene fallas catastróficas. Monitorea la temperatura de tu maquinaria crítica en **tiempo
                real**
                utilizando sensores IoT. Recibe **alertas instantáneas** antes de que sea demasiado tarde.
            </p>

            @auth
                <a href="{{ route('welcome') }}" class="hero-btn hero-btn--primary">Ir al Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hero-btn hero-btn--primary">Iniciar Monitoreo</a>
                <a href="{{ route('register') }}" class="hero-btn hero-btn--secondary">Solicitar Demo</a>
            @endauth
        </div>
    </section>

    <main class="main-content">

        {{-- ✅ SECCIÓN BENEFICIOS --}}
        <section class="intro-section text-center" id="beneficios">
            <h2 class="section-title">El Poder de la Termovigilancia en tu Industria</h2>
            <p class="intro-text">
                La temperatura es el indicador clave de la salud de tu equipo. Con ThermoWatch, pasas de un
                mantenimiento reactivo a una **predicción inteligente**.
            </p>
        </section>

        {{-- GRID DE ESTADÍSTICAS --}}
        <div class="stats-grid-wrapper">
            <div class="stats-grid">
                {{-- Los colores temáticos se definen en styles.css para ser coherentes --}}
                <div class="stat-card">
                    <span class="stat-icon text-red-600"><i class="fas fa-bolt"></i></span>
                    <p class="stat-number">95%</p>
                    <p class="stat-label">Reducción de Fallas Críticas</p>
                </div>
                <div class="stat-card">
                    <span class="stat-icon text-blue-600"><i class="fas fa-industry"></i></span>
                    <p class="stat-number">24/7</p>
                    <p class="stat-label">Vigilancia Continua</p>
                </div>
                <div class="stat-card">
                    <span class="stat-icon text-orange-600"><i class="fas fa-exclamation-triangle"></i></span>
                    <p class="stat-number">0.5s</p>
                    <p class="stat-label">Tiempo de Alerta Promedio</p>
                </div>
                <div class="stat-card">
                    <span class="stat-icon text-green-600"><i class="fas fa-cogs"></i></span>
                    <p class="stat-number">Mantenimiento</p>
                    <p class="stat-label">Predictivo Implementado</p>
                </div>
            </div>
        </div>

        {{-- 💡 SECCIÓN TECNOLOGÍA --}}
        <h2 class="section-title" id="tecnologia">Nuestra Tecnología</h2>
        <div class="feature-cards">
            {{-- Las cards usan border-top azul de tecnología en styles.css --}}
            <div class="feature-card">
                <h3><i class="fas fa-microchip mr-2"></i> Sensores IoT</h3>
                <p>Nuestra red de dispositivos inalámbricos recopila datos de temperatura con alta precisión, diseñados
                    para ambientes industriales adversos.</p>
            </div>

            <div class="feature-card">
                <h3><i class="fas fa-bell mr-2"></i> Alertas Inteligentes</h3>
                <p>Configura umbrales (mín/máx) y recibe notificaciones push/email instantáneas en tu PWA o móvil si se
                    detecta una anomalía térmica.</p>
            </div>

            <div class="feature-card">
                <h3><i class="fas fa-chart-area mr-2"></i> Dashboard en Tiempo Real</h3>
                <p>Visualiza el estado de toda tu maquinaria en un panel unificado, con gráficos de tendencia e
                    historial detallado para el análisis.</p>
            </div>
        </div>
    </main>

    {{-- 📞 FOOTER --}}
    {{-- El footer utiliza el color de fondo oscuro de styles.css --}}
    <footer class="footer" id="contacto">
        <p>© 2025 ThermoWatch | Prevención y Productividad Industrial</p>
        <p>Contacto: soporte@thermowatch.com | Tel: +52 81 5555 1234</p>
    </footer>

    {{-- Banner de conexión/desconexión (PWA) --}}
    <div id="connection-status" class="connection-banner hidden"></div>

    <script>
        // Script de detección de conexión (se mantiene igual, funciona con styles.css)
        document.addEventListener('DOMContentLoaded', () => {
            const banner = document.getElementById('connection-status');
            function showStatus(isOnline) {
                banner.textContent = isOnline
                    ? '✅ Conexión restaurada — estás en línea'
                    : '⚠️ Estás sin conexión — Modo PWA offline activo';
                banner.className = `connection-banner ${isOnline ? 'online' : 'offline'}`;
                banner.classList.remove('hidden');

                if (isOnline) {
                    setTimeout(() => banner.classList.add('hidden'), 4000);
                }
            }
            window.addEventListener('online', () => showStatus(true));
            window.addEventListener('offline', () => showStatus(false));
            if (!navigator.onLine) showStatus(false);
        });
    </script>
</body>

</html>