<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Muestra el formulario para configurar los umbrales de los sensores IoT.
     * Corresponde a la ruta 'admin.config.umbrales'.
     */
    public function umbrales()
    {
        // Debes crear esta vista en resources/views/admin/umbrales.blade.php
        return view('admin.umbrales');
    }

    /**
     * Muestra la configuración general del sistema.
     * Corresponde a la ruta 'admin.config' (asumiendo que la necesitas).
     */
    public function index()
    {
        return view('admin.config');
    }
}