<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Media;
use App\Models\Annonceur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // -------------------------------
        // Administrateurs
        // -------------------------------
        $roles = ['SuperAdmin', 'Admin', 'Proprietaire'];
        foreach ($roles as $role) {
            $user = User::create([
                'name' => $role,
                'email' => strtolower($role).'@example.com',
                'password' => Hash::make('password'),
                'actif' => true,
                'email_verified_at' => now(),
            ]);
            $user->assignRole($role);
        }

        // -------------------------------
        // Annonceurs
        // -------------------------------
        $annonceursData = [
            ['Jean Annonceur', 'annonceur1@example.com', true],
            ['Marie Annonceur', 'annonceur2@example.com', false],
            ['Paul Annonceur', 'annonceur3@example.com', true],
        ];

        foreach ($annonceursData as $data) {
            $user = User::create([
                'name' => $data[0],
                'email' => $data[1],
                'password' => Hash::make('password'),
                'actif' => $data[2],
                'email_verified_at' => now(),
            ]);
            $user->assignRole('Annonceur');

            Annonceur::create([
                'nom' => $data[0],
                'email' => $data[1],
                'actif' => $data[2],
            ]);
        }

        // -------------------------------
        // Medias
        // -------------------------------
        $mediasData = [
            ['Julie Media', 'media1@example.com'],
            ['Paul Media', 'media2@example.com'],
        ];

        foreach ($mediasData as $data) {
            $user = User::create([
                'name' => $data[0],
                'email' => $data[1],
                'password' => Hash::make('password'),
                'actif' => true,
                'email_verified_at' => now(),
            ]);
            $user->assignRole('Media');

            // Plusieurs médias par utilisateur
            for ($i=1; $i<=2; $i++) {
                Media::create([
                    'user_id' => $user->id,
                    'nom_du_media' => $data[0]." $i",
                    'url_site' => 'https://media-'.Str::slug($data[0])."-".$i.".example.com",
                    'media_token' => Str::random(40),
                    'total_vues' => rand(0,1000),
                    'total_clics' => rand(0,500),
                    'revenu_actuel' => rand(0,500),
                    'paiement_demande' => false,
                ]);
            }
        }

        // -------------------------------
        // Utilisateurs simples
        // -------------------------------
        for ($i=1; $i<=2; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
                'actif' => true,
                'email_verified_at' => now(),
            ]);
        }
    }
}
