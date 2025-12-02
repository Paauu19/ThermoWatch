<?php
// routes/web.php (Solo secciones relevantes modificadas)

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS Y AUTENTICACIÓN
|--------------------------------------------------------------------------
*/
// 1. Landing Page (Redirige al dashboard si está logueado)
Route::get('/', function () {
    return Auth::check() ? redirect()->route('welcome') : view('index');
})->name('index');

// 2. Carga todas las rutas de AUTENTICACIÓN (login, register, forgot-password, etc.)
// Estas rutas DEBEN estar fuera del middleware 'auth' para ser accesibles por invitados.
require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| RUTAS PRIVADAS (Usuarios autenticados)
|--------------------------------------------------------------------------
*/
// Todas las rutas aquí requieren estar logueado
Route::middleware(['auth', 'verified'])->group(function () {

    // Página de bienvenida unificada (dashboard)
    Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');

    // Página del juego UTSC Strikers
    Route::get('/game', function () {
        return view('game_page'); // Apunta a game_page.blade.php
    })->name('game_page');

    // Rutas de Perfil (ProfileController)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | OPERADOR y ADMIN (Rutas de trabajo)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:operador|administrador'])->group(function () {
        Route::get('/dashboard/monitoreo', [HomeController::class, 'monitoreoDashboard'])->name('operador.dashboard');
        Route::get('/operador/inventario', [HomeController::class, 'inventario'])->name('operador.inventario');
        Route::get('/operador/reportes', [HomeController::class, 'reportes'])->name('operador.reportes');
        Route::get('/operador/mapa', [HomeController::class, 'mapa'])->name('operador.mapa');
    });

    /*
    |--------------------------------------------------------------------------
    | RUTAS ADMIN (Solo Administrador)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:administrador'])->group(function () {
        Route::resource('usuarios', UserController::class)->names('administracion.usuarios');
        Route::get('/admin/config/umbrales', [ConfigController::class, 'umbrales'])->name('admin.config.umbrales');
        Route::get('/admin/config', [ConfigController::class, 'index'])->name('admin.config');
    });
});