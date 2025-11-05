<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Usuario Administrador (Acceso total)
        User::create([
            'name' => 'Admin: Paola Coronado',
            'email' => 'paola.admin@virtual.utsc.edu.mx',
            'password' => Hash::make('admin21002'),
            // 🚨 CORREGIDO: Rol de 'admin' a 'administrador'
            'role' => 'administrador',
            'email_verified_at' => now(),
        ]);

        // 2. Usuario Operador (Empleado/Rol intermedio)
        User::create([
            'name' => 'Operador: Paola Coronado',
            'email' => 'paola.operador@virtual.utsc.edu.mx',
            'password' => Hash::make('operador21002'),
            // 🚨 CORREGIDO: Rol de 'guardaparque' a 'operador'
            'role' => 'operador',
            'email_verified_at' => now(),
        ]);

        // 3. Usuario General (Rol por defecto, será bloqueado en el login)
        User::create([
            'name' => 'Usuario Invitado (Bloqueado)',
            'email' => '21002@virtual.utsc.edu.mx',
            'password' => Hash::make('21002'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}