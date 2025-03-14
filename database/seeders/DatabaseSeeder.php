<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Llamamos al seeder de roles y permisos
         $this->call(RolePermissionSeeder::class);

         $this->command->info('✅ Base de datos inicializada con roles y usuario adminMm.');
    }
}
