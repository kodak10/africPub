<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publicite;
use App\Models\Annonceur;
use App\Models\Forfait;

class PublicitesSeeder extends Seeder
{
    public function run(): void
    {
        $annonceurs = Annonceur::all();
        $forfaits = Forfait::all();
        $statuts = ['brouillon','en_attente_paiement','en_attente_validation','approuve','rejete'];

        foreach ($annonceurs as $annonceur) {
            foreach ($statuts as $index => $statut) {
                Publicite::create([
                    'annonceur_id' => $annonceur->id,
                    'titre' => "Pub {$index} de {$annonceur->nom}",
                    'type_media' => 'image',
                    'fichier' => "publicites/pub{$index}.jpg",
                    'url_cible' => 'https://example.com',
                    'forfait_id' => $forfaits->random()->id,
                    'statut' => $statut,
                ]);
            }
        }
    }
}
