<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@demo.com',
            'password' => bcrypt('password'),
            'phone' => '0999999999',
            'status' => 'activo',
            'role_id' => 1 // Admin
        ]);

        // Usuario organizador
        User::create([
            'name' => 'Organizador Demo',
            'email' => 'organizador@demo.com',
            'password' => bcrypt('password'),
            'phone' => '0988888888',
            'status' => 'activo',
            'role_id' => 2 // Organizador


        ]);

        // Usuario normal
        User::create([
            'name' => 'Usuario Prueba',
            'email' => 'usuario@demo.com',
            'password' => bcrypt('password'),
            'phone' => '0977777777',
            'status' => 'activo',
            'role_id' => 3 // Usuario
        ]);
    }
}
