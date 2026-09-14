<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador Principal de BANTEL
        User::updateOrCreate(
            ['email' => 'admin@bantel.pe'],
            [
                'name' => 'Administrador BANTEL',
                'password' => Hash::make('Bantel2026*'),
                'role' => 'ADMIN',
            ]
        );

        // Gestor de Contenidos CAD
        User::updateOrCreate(
            ['email' => 'gestor@bantel.pe'],
            [
                'name' => 'Gestor de Contenidos CAD',
                'password' => Hash::make('Gestor2026*'),
                'role' => 'CONTENT_MANAGER',
            ]
        );

        // Perfil Consulta PRONATEL
        User::updateOrCreate(
            ['email' => 'consulta@pronatel.gob.pe'],
            [
                'name' => 'Supervisor PRONATEL',
                'password' => Hash::make('Consulta2026*'),
                'role' => 'VIEWER',
            ]
        );
    }
}