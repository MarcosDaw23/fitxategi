<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insertar roles
        DB::table('rol')->insert([
            ['id' => 1, 'nombre' => 'ADMIN'],
            ['id' => 2, 'nombre' => 'USUARIO'],
            ['id' => 3, 'nombre' => 'SUPERVISOR'],
        ]);

        // Insertar empresas
        DB::table('empresa')->insert([
            ['id' => 1, 'nombre' => 'Empresa General'],
            ['id' => 2, 'nombre' => 'Empresa Tecnología'],
        ]);

        // Insertar usuarios
        DB::table('usuario')->insert([
            [
                'id' => 1,
                'nombre' => 'Administrador',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'horario' => '08:00-17:00',
                'activo' => true,
                'mac' => '00:1A:2B:3C:4D:5E',
                'rol_id' => 1,
                'empresa_id' => 1,
                'fecha_ini' => '2026-01-01',
                'fecha_fin' => null,
                'horas_extra' => 0.00,
            ],
            [
                'id' => 2,
                'nombre' => 'Usuario General',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'horario' => '09:00-18:00',
                'activo' => true,
                'mac' => '00:1A:2B:3C:4D:5F',
                'rol_id' => 2,
                'empresa_id' => 1,
                'fecha_ini' => '2026-01-05',
                'fecha_fin' => null,
                'horas_extra' => 2.50,
            ],
            [
                'id' => 3,
                'nombre' => 'Supervisor',
                'email' => 'supervisor@example.com',
                'password' => bcrypt('password'),
                'horario' => '07:00-16:00',
                'activo' => true,
                'mac' => '00:1A:2B:3C:4D:60',
                'rol_id' => 3,
                'empresa_id' => 2,
                'fecha_ini' => '2026-01-10',
                'fecha_fin' => null,
                'horas_extra' => 1.75,
            ],
        ]);

        // Insertar prácticas
        DB::table('practicas')->insert([
            ['id' => 1, 'usuario_id' => 2, 'empresa_id' => 1],
            ['id' => 2, 'usuario_id' => 3, 'empresa_id' => 2],
        ]);

        // Insertar incidencias
        DB::table('incidencias')->insert([
            [
                'id' => 1,
                'id_usuario' => 2,
                'fecha' => '2026-01-15',
                'descripcion' => 'Llegada tarde',
                'justificacion' => 'Tráfico intenso',
            ],
            [
                'id' => 2,
                'id_usuario' => 3,
                'fecha' => '2026-01-12',
                'descripcion' => 'Falta de asistencia',
                'justificacion' => 'Cita médica',
            ],
        ]);

        // Insertar fichajes
        DB::table('fichaje')->insert([
            [
                'id' => 1,
                'id_usuario' => 2,
                'fecha' => '2026-01-15',
                'fecha_original' => '2026-01-15',
                'hora_entrada' => '09:05',
                'hora_salida' => '18:00',
                'estado' => 'Presente',
            ],
            [
                'id' => 2,
                'id_usuario' => 3,
                'fecha' => '2026-01-12',
                'fecha_original' => '2026-01-12',
                'hora_entrada' => '07:00',
                'hora_salida' => '16:00',
                'estado' => 'Presente',
            ],
            [
                'id' => 3,
                'id_usuario' => 2,
                'fecha' => '2026-01-16',
                'fecha_original' => '2026-01-16',
                'hora_entrada' => '09:00',
                'hora_salida' => '18:30',
                'estado' => 'Horas extra',
            ],
        ]);
    }
}
