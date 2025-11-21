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
        // ---------------------------------------------------------
        // ADMINISTRATEURS
        // ---------------------------------------------------------
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

        // ---------------------------------------------------------
        // ANNONCEURS
        // ---------------------------------------------------------
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

        // ---------------------------------------------------------
        // MÉDIAS (5 minimum)
        // ---------------------------------------------------------
        $mediasData = [
            ['RTI Info', 'rti-info@example.com'],
            ['Life TV', 'life-tv@example.com'],
            ['KOACI News', 'koaci-news@example.com'],
            ['Abidjan People', 'abidjan-people@example.com'],
            ['Afrik Media', 'afrik-media@example.com'],
        ];

        foreach ($mediasData as $data) {
            $user = User::create([
                'name'  => $data[0],
                'email' => $data[1],
                'password' => Hash::make('password'),
                'actif' => true,
                'email_verified_at' => now(),
            ]);

            $user->assignRole('Media');

            // Création du média
            Media::create($this->generateFakeMedia($user->id, $data[0]));
        }

        // ---------------------------------------------------------
        // UTILISATEURS SIMPLES
        // ---------------------------------------------------------
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
                'actif' => true,
                'email_verified_at' => now(),
            ]);
        }
    }

    // ---------------------------------------------------------
    // FONCTION DE GÉNÉRATION DE MÉDIA
    // ---------------------------------------------------------
    private function generateFakeMedia($userId, $mediaName)
    {
        return [
            'user_id' => $userId,
            'nom_du_media' => $mediaName,
            'url_site' => 'https://' . Str::slug($mediaName) . '.ci',
            'numero_rccm' => 'CI-ABJ-' . rand(10000, 99999),
            'telephone' => '+2250' . rand(10000000, 79999999),
            'email' => Str::slug($mediaName).'@media.ci',
            'logo_media' => null,
            'adresse' => 'Abidjan, Côte d’Ivoire',
            'description' => 'Media officiel : ' . $mediaName,
            'media_token' => Str::random(40),
            'total_vues' => rand(1000, 50000),
            'total_clics' => rand(100, 5000),
            'revenu_actuel' => rand(5000, 200000) / 10,
            'paiement_demande' => false,
            'statut' => 'validé', // tu peux changer si besoin
        ];
    }
}
