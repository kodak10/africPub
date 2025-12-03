<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Admins
        Role::firstOrCreate(['name' => 'SuperAdmin']);
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Proprietaire']);

        // Utilisateurs fonctionnels
        Role::firstOrCreate(['name' => 'Annonceur']);
        Role::firstOrCreate(['name' => 'Media']); 
    }
}
