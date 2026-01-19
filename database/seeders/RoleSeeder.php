<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'estudiante',
                'description' => 'Usuario estudiante con acceso básico para registrar asistencia',
            ],
            [
                'name' => 'profesor',
                'description' => 'Profesor o responsable del espacio con acceso a reportes y validación',
            ],
            [
                'name' => 'administrador',
                'description' => 'Administrador con acceso completo al sistema',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}
