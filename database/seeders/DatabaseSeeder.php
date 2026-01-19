<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles primero
        $this->call(RoleSeeder::class);

        // Obtener los roles
        $adminRole = Role::where('name', 'administrador')->first();
        $teacherRole = Role::where('name', 'profesor')->first();
        $studentRole = Role::where('name', 'estudiante')->first();

        // Crear usuario administrador
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@fitxategi.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'identification' => 'ADM001',
            'is_active' => true,
        ]);

        // Crear usuario profesor
        User::create([
            'name' => 'Profesor Demo',
            'email' => 'profesor@fitxategi.com',
            'password' => Hash::make('password'),
            'role_id' => $teacherRole->id,
            'identification' => 'PROF001',
            'is_active' => true,
        ]);

        // Crear usuario estudiante
        User::create([
            'name' => 'Estudiante Demo',
            'email' => 'estudiante@fitxategi.com',
            'password' => Hash::make('password'),
            'role_id' => $studentRole->id,
            'identification' => 'EST001',
            'phone' => '600123456',
            'is_active' => true,
        ]);
    }
}
