<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ThermoWatch | Dashboard de Monitoreo</title>

    {{-- Tailwind y FontAwesome --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Alpine.js para menús interactivos --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .stat-card-industrial {
            background-color: #ffffff;
            border-left: 5px solid #1E88E5;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .stat-alert {
            background-color: #FFF3E0;
            border-left: 5px solid #FF5733;
        }

        .text-fire {
            color: #FF5733;
        }

        .text-green-700 {
            color: #4CAF50;
        }

        .text-red-700 {
            color: #D32F2F;
        }

        .text-yellow-600 {
            color: #FFC107;
        }

        .text-blue-600 {
            color: #1E88E5;
        }

        body {
            background-color: #ECEFF1;
        }
    </style>
</head>

<body>
    {{-- Barra de navegación --}}
    @include('layouts.navigation')

    <main class="dashboard-container">
        {{-- Header --}}
        <header class="mb-8 p-4 bg-white shadow-md rounded-lg">
            <h1 class="text-3xl font-bold text-gray-800">
                ¡Bienvenido, {{ Auth::user()->name }}!
                <span class="text-sm font-medium text-gray-500">({{ ucfirst(Auth::user()->role) }})</span>
            </h1>
            <p class="text-gray-600 mt-1">Panel central de ThermoWatch para el monitoreo y gestión de la planta.</p>
        </header>

        {{-- Resumen Maquinaria Crítica --}}
        <section class="mb-10 p-6 bg-white shadow-xl rounded-lg border-t-4 border-fire">
            <h2 class="text-2xl font-semibold mb-4 flex items-center">
                <i class="fas fa-thermometer-half mr-2 text-fire"></i> Resumen de Maquinaria Crítica
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Máquina A-01 --}}
                <div id="card-A01" class="stat-card-industrial">
                    <p class="text-sm font-medium text-gray-600">Máquina A-01 | Motor Principal</p>
                    <p class="text-3xl font-bold text-green-700 mt-1"><span id="temp-A01">25.3</span> °C</p>
                    <div class="text-sm mt-2 flex items-center">
                        <i class="fas fa-check-circle mr-1 text-green-700"></i> Estado: <span
                            id="status-A01">Normal</span>
                    </div>
                </div>

                {{-- Máquina B-03 --}}
                <div id="card-B03" class="stat-card-industrial stat-alert">
                    <p class="text-sm font-medium text-gray-600">Máquina B-03 | Compresor</p>
                    <p class="text-3xl font-bold text-red-700 mt-1"><span id="temp-B03">85.1</span> °C</p>
                    <div class="text-sm mt-2 flex items-center font-bold text-red-700">
                        <i class="fas fa-exclamation-triangle mr-1"></i> <span id="status-B03">¡ALERTA MÁXIMA!</span>
                    </div>
                </div>

                {{-- Alerta Reciente --}}
                <div class="stat-card-industrial">
                    <p class="text-sm font-medium text-gray-600">Alerta Reciente</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">3 Horas</p>
                    <div class="text-sm mt-2 flex items-center">
                        <i class="fas fa-bell mr-1 text-yellow-600"></i> Última alarma: B-03
                    </div>
                </div>
            </div>

            {{-- Botones de acceso --}}
            <div class="mt-6 text-center space-y-2">
                <a href="{{ route('operador.dashboard') }}"
                    class="inline-block px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-chart-bar mr-2"></i> Ir al Dashboard Detallado
                </a>

                <a href="{{ route('game_page') }}"
                    class="inline-block px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-futbol mr-2"></i> Ir a UTSC Strikers
                </a>
            </div>
        </section>

        {{-- Funciones rápidas por rol --}}
        <section class="p-6 bg-white shadow-xl rounded-lg">
            <h2 class="text-2xl font-semibold mb-6 flex items-center">
                <i class="fas fa-toolbox mr-2 text-blue-600"></i> Funciones de Trabajo Rápido
            </h2>

            @include('partials.action_boards_thermowatch', ['user' => Auth::user()])
        </section>
    </main>

    {{-- JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>