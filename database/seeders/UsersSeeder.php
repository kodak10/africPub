<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Media;
use App\Models\Annonceur;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {

        // 🔹 1️⃣ SuperAdmin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'actif' => true,
            ]
        );
        $superAdmin->assignRole('SuperAdmin');

        // 🔹 2️⃣ Propriétaire
        $proprietaire = User::firstOrCreate(
            ['email' => 'proprietaire@example.com'],
            [
                'name' => 'Super Propriétaire',
                'password' => Hash::make('password'),
                'actif' => true,
            ]
        );
        $proprietaire->assignRole('Proprietaire');

        // 🔹 3️⃣ Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'actif' => true,
            ]
        );
        $admin->assignRole('Admin');

        // 🔹 4️⃣ Annonceurs (4)
        for ($i = 1; $i <= 4; $i++) {
            $user = User::firstOrCreate(
                ['email' => "annonceur{$i}@example.com"],
                [
                    'name' => "Annonceur {$i}",
                    'password' => Hash::make('password'),
                    'actif' => true,
                ]
            );
            $user->assignRole('Annonceur');

            // Créer le profil Annonceur
            Annonceur::firstOrCreate(
                ['email' => $user->email],
                [
                    'nom' => $user->name,
                    'telephone' => '22500000000',
                    'adresse' => 'Abidjan',
                    'statut' => 'validé',
                ]
            );
        }

        // 🔹 5️⃣ Médias (5)
        for ($i = 1; $i <= 5; $i++) {
            $user = User::firstOrCreate(
                ['email' => "media{$i}@example.com"],
                [
                    'name' => "Media {$i}",
                    'password' => Hash::make('password'),
                    'actif' => true,
                ]
            );
            $user->assignRole('Media');

            // Créer le profil Media
            Media::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nom_du_media' => $user->name,
                    'url_site' => "https://media{$i}.example.com",
                    'numero_rccm' => 'CI123456789',
                    'telephone' => '22511111111',
                    'email' => $user->email,
                    'adresse' => 'Abidjan',
                    'media_token' => 'media-token-'.$i,
                    'statut' => 'en attente',
                ]
            );
        }
    }
}
