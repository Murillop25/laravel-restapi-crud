<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactivar restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
        // Limpiar tablas para evitar duplicados
        DB::table('role_user')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
    
        // Insertar roles
        $roles = ['admin', 'director', 'maestro', 'supervisor', 'estudiante'];
        $roleIds = [];
    
        foreach ($roles as $role) {
            $roleIds[$role] = DB::table('roles')->insertGetId([
                'name' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        // Crear usuario admin por defecto con los nuevos campos
        $adminId = DB::table('users')->insertGetId([
            'name'       => 'Admin',
            'lastname'   => 'Master',
            'username'   => 'adminMm',
            'email'      => 'admin@example.com',
            'password'   => Hash::make('adminMm'), // Encriptar la contraseña
            'birthdate'  => '2000-01-01', // Ajusta según sea necesario
            'role'       => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Asignar el rol admin al usuario adminMm
        DB::table('role_user')->insert([
            'user_id'    => $adminId,           
            'role_id'    => $roleIds['admin'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        $this->command->info('✅ Se ha creado el usuario adminMm con contraseña adminMm y rol admin.');
    
        // Puedes agregar más usuarios o roles si es necesario aquí
    }
}
