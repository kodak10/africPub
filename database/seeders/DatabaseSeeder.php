<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            ForfaitsSeeder::class,
            PublicitesSeeder::class,       // à créer avant PubliciteMediaSeeder
            PubliciteMediaSeeder::class,
            VuesPublicitesSeeder::class,
            ClicsPublicitesSeeder::class,
            DemandesPaiementSeeder::class,
            HistoriquePaiementsSeeder::class,
            
        ]);
    }


}
