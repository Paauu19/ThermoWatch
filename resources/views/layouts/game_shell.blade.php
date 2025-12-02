<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('styles')
</head>

<body class="bg-light">

    {{-- ===== HEADER ===== --}}
    <header class="header">
        <div class="header-container container">
            <h1>UTSC Strikers</h1>
            <nav class="nav-links">
                <a href="#jugar">Jugar</a>
                <a href="#features">Características</a>
                <a href="#teams">Equipos</a>
                <a href="#requirements">Requisitos</a>
                <a href="#history">Historia</a>
            </nav>
        </div>
    </header>

    {{-- ===== CONTENIDO PRINCIPAL ===== --}}
    <main style="margin-top:100px;">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="footer">
        <p>© {{ date('Y') }} UTSC Strikers — Proyecto UTSC Games</p>
        <button id="installAppBtn" class="download-btn">
            <i class="fas fa-download"></i> Instalar UTSC Strikers
        </button>
    </footer>

    {{-- ===== MODAL GALERÍA ===== --}}
    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    @yield('scripts')
</body>

</html>