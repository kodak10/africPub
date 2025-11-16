<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use App\Models\DemandePaiement;
use Illuminate\Support\Str;

class DemandesPaiementSeeder extends Seeder
{
    public function run(): void
    {
        $medias = Media::all();
        $statuts = ['en_attente', 'paye', 'rejete'];

        foreach ($medias as $media) {
            // Chaque media peut avoir 1 à 3 demandes
            $nbDemandes = rand(1, 3);

            for ($i = 0; $i < $nbDemandes; $i++) {
                DemandePaiement::create([
                    'media_id' => $media->id,
                    'montant' => rand(1000, 5000),  // montant aléatoire
                    'statut' => $statuts[array_rand($statuts)],
                ]);
            }
        }
    }
}
