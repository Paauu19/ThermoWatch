@extends('layouts.game_shell')
@section('title', 'UTSC Soccer Legends - Juego Oficial')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/game_page.css') }}">
@endsection

@section('content')

    {{-- ===== BOTÓN VOLVER AL DASHBOARD ===== --}}
    <div class="container my-6 text-center">
        <a href="{{ route('welcome') }}"
            class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Volver al Dashboard
        </a>
    </div>

    {{-- ===== DEMO JUEGO - AL INICIO ===== --}}
    <section id="jugar" class="features bg-dark">
        <div class="container text-center">
            <h2 class="section-title text-white">🕹️ Juega al Instante</h2>
            <div class="game-frame-container">
                <iframe id="gameIframe" src="{{ asset('game/UTSC_Strikers.html') }}" class="game-frame"
                    allowfullscreen></iframe>
            </div>
            <button id="playFullScreenBtn" class="download-btn mt-4">
                <i class="fas fa-expand"></i> Jugar en Pantalla Completa
            </button>
        </div>
    </section>

    {{-- ===== ESTADÍSTICAS RÁPIDAS ===== --}}
    <section class="stats bg-light">
        <div class="container stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-number">12</div>
                <div class="stat-label">Equipos</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-futbol"></i></div>
                <div class="stat-number">5</div>
                <div class="stat-label">Modos de Juego</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-trophy"></i></div>
                <div class="stat-number">3</div>
                <div class="stat-label">Torneos Disponibles</div>
            </div>
        </div>
    </section>

    {{-- ===== CARACTERÍSTICAS CLAVE ===== --}}
    <section id="features" class="features bg-light">
        <div class="container">
            <h2 class="section-title">Características Clave</h2>
            <div class="features-grid">
                <div class="feature-card dark">
                    <div class="feature-icon"><i class="fas fa-desktop"></i></div>
                    <h3>Jugabilidad 2D</h3>
                    <p>Movimientos y física que incluyen colisiones de jugadores y pelota, tiros y pases precisos.</p>
                </div>
                <div class="feature-card dark">
                    <div class="feature-icon"><i class="fas fa-robot"></i></div>
                    <h3>IA Adaptativa</h3>
                    <p>Oponentes CPU que taclean, patean y el portero realiza bloqueos inteligentes.</p>
                </div>
                <div class="feature-card dark">
                    <div class="feature-icon"><i class="fas fa-hand-rock"></i></div>
                    <h3>Controles Dinámicos</h3>
                    <p>Controla hasta dos jugadores y coordina pases estratégicos en tiempo real.</p>
                </div>
                <div class="feature-card dark">
                    <div class="feature-icon"><i class="fas fa-trophy"></i></div>
                    <h3>Sistema de Torneos</h3>
                    <p>Participa en ligas y campeonatos para alcanzar la gloria y desbloquear celebraciones.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== HISTORIA / VÍNCULO ===== --}}
    <section id="history" class="features bg-light">
        <div class="container">
            <h2 class="section-title">Historia y Vínculo BioTrack</h2>
            <p style="text-align:center; max-width:800px; margin:auto;">
                UTSC Soccer Legends integra entretenimiento y educación, permitiendo que el jugador aprenda sobre BioTrack
                mientras participa en un Mundial 2025 virtual.
            </p>
        </div>
    </section>

    {{-- ===== EQUIPOS / PERSONALIZACIÓN ===== --}}
    <section id="teams" class="features bg-dark">
        <div class="container">
            <h2 class="section-title text-white">Equipos y Personalización</h2>
            <div class="features-grid">
                <div class="feature-card dark">
                    <h3>Registro de Skins</h3>
                    <p>Variedad de skins y uniformes para crear tu equipo ideal.</p>
                </div>
                <div class="feature-card dark">
                    <h3>Personalización de Avatares</h3>
                    <p>Selecciona tu avatar y personaje para tener una experiencia única.</p>
                </div>
                <div class="feature-card dark">
                    <h3>Control de la Liga</h3>
                    <p>Los equipos CPU tienen etiquetas de control (Humano/IA) y se agregan manualmente para equipos de 6
                        personas.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== REQUISITOS / CONTROLES ===== --}}
    <section id="requirements" class="features bg-light">
        <div class="container">
            <h2 class="section-title">⚙️ Requisitos del Sistema y Controles</h2>
            <div class="requirements-grid features-grid">
                <div class="feature-card">
                    <h3>Requisitos del Sistema</h3>
                    <ul>
                        <li>Windows, macOS, o Linux.</li>
                        <li>Procesador Dual Core 2.0 GHz o superior.</li>
                        <li>2 GB de RAM o más.</li>
                        <li>Revisar el Manual de Usuario antes de instalar.</li>
                    </ul>
                </div>
                <div class="feature-card">
                    <h3>Controles del Videojuego</h3>
                    <ul>
                        <li>Movimiento del Jugador.</li>
                        <li>Tiro y Patada.</li>
                        <li>Pases estratégicos.</li>
                    </ul>
                </div>
                <div class="feature-card">
                    <h3>Objetivo del Jugador</h3>
                    <p>Anotar goles mientras la IA rival intenta evitarlo utilizando habilidades y coordinación.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== GALERÍA DE CAPTURAS ===== --}}
    {{-- <section class="screenshots bg-dark">
        <div class="container">
            <h2 class="section-title text-white">Galería de Capturas</h2>
            <div class="screenshots-grid">
                <div class="screenshot"><img src="{{ secure_asset('game/game_image1.png') }}" onclick="showModal(this.src)">
                </div>
                <div class="screenshot"><img src="{{ secure_asset('game/game_image2.png') }}" onclick="showModal(this.src)">
                </div>
                <div class="screenshot"><img src="{{ secure_asset('game/game_image3.png') }}" onclick="showModal(this.src)">
                </div>
                <div class="screenshot"><img src="{{ secure_asset('game/game_image4.png') }}" onclick="showModal(this.src)">
                </div>
            </div>
        </div>
    </section> --}}

    {{-- ===== MODAL DE IMÁGENES ===== --}}
    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Función modal para capturas
            window.showModal = function (src) {
                const modal = document.getElementById("imageModal");
                const modalImg = document.getElementById("modalImage");
                modal.style.display = "block";
                modalImg.src = src;
            }

            window.closeModal = function () {
                document.getElementById("imageModal").style.display = "none";
            }

            // Pantalla completa
            const playBtn = document.getElementById("playFullScreenBtn");
            if (playBtn) {
                playBtn.addEventListener("click", function () {
                    const iframe = document.getElementById("gameIframe");
                    if (iframe.requestFullscreen) iframe.requestFullscreen();
                    else if (iframe.webkitRequestFullscreen) iframe.webkitRequestFullscreen();
                    else if (iframe.msRequestFullscreen) iframe.msRequestFullscreen();
                });
            }
        });
    </script>
@endsection