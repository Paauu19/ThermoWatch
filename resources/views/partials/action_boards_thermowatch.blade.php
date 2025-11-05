@php
    // Usamos los roles definidos: administrador y operador
    $isAdmin = $user->role === 'administrador';
    $isOperador = $user->role === 'operador' || $isAdmin; // El administrador incluye las funciones de operador

    // Determinar la estructura de la cuadrícula
    $columns = $isAdmin ? 'md:grid-cols-3' : 'md:grid-cols-2';
    $padding = 'p-8';
@endphp

<div class="grid grid-cols-1 {{ $columns }} gap-6 mx-auto text-center">

    {{-- ADMINISTRADOR (Roles, Configuración IoT y del Sistema) --}}
    @if($isAdmin)
        <a href="{{ route('administracion.usuarios.index') }}"
            class="action-card bg-administrador {{ $padding }} text-xl rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
            <i class="fas fa-users-cog mr-2"></i> Gestión de Personal
        </a>

        {{-- Enlace temático: Configuración de Umbrales (PWA-07) --}}
        <a href="{{ route('admin.config.umbrales') }}"
            class="action-card bg-administrador {{ $padding }} text-xl rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
            <i class="fas fa-microchip mr-2"></i> Configuración de Umbrales IoT
        </a>

        {{-- Enlace temático: Configuración general del sitio/PWA --}}
        <a href="{{ route('admin.config') }}"
            class="action-card bg-administrador {{ $padding }} text-xl rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
            <i class="fas fa-cogs mr-2"></i> Configuración del Sistema
        </a>
    @endif

    {{-- OPERADOR (Acciones de Monitoreo Industrial) --}}
    @if($isOperador)
        {{-- Dashboard de Alertas (PWA-08) --}}
        <a href="{{ route('operador.dashboard') }}"
            class="action-card bg-operador {{ $padding }} text-xl rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
            <i class="fas fa-chart-line mr-2"></i> Dashboard de Monitoreo en Vivo
        </a>

        {{-- CRUD de Maquinaria (PWA-04) --}}
        <a href="{{ route('operador.inventario') }}"
            class="action-card bg-operador {{ $padding }} text-xl rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
            <i class="fas fa-industry mr-2"></i> Inventario y Gestión de Maquinaria
        </a>

        {{-- Reportes Históricos (PWA-09, PWA-11) --}}
        <a href="{{ route('operador.reportes') }}"
            class="action-card bg-operador {{ $padding }} text-xl rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
            <i class="fas fa-file-export mr-2"></i> Reportes Históricos y Métricas
        </a>

        {{-- Mapa de Ubicación (PWA-10) --}}
        <a href="{{ route('operador.mapa') }}"
            class="action-card bg-operador {{ $padding }} text-xl rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
            <i class="fas fa-map-marked-alt mr-2"></i> Mapa de Ubicación de Planta
        </a>
    @endif
</div>