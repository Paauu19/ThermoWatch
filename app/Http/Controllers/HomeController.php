<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Datos dinámicos para las tarjetas de estadísticas
        $stats = [
            'usuarios' => User::count(),
        ];

        return view('welcome', compact('user', 'stats'));
    }
}
