<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publicite;
use App\Models\Annonceur;
use App\Models\Forfait;
use App\Models\Media;

class PublicitesSeeder extends Seeder
{
    public function run(): void
    {
        $medias = Media::all();
        $forfaits = Forfait::all();
        $annonceurs = Annonceur::all();
        $statuts = ['brouillon','en_attente_paiement','en_attente_validation','rejete'];
        $fichier = 'publicites/image.jpg';
        $totalPubs = 0;

        // 1️⃣ Au moins 4 pubs par média
        foreach ($medias as $media) {
            for ($i = 0; $i < 4; $i++) {
                $annonceur = $annonceurs->random(); // ID valide
                Publicite::create([
                    'annonceur_id' => $annonceur->id,
                    'titre' => "Pub {$i} pour {$media->nom_du_media}",
                    'type_media' => 'image',
                    'media_path' => $fichier,
                    'url_cible' => 'https://example.com',
                    'forfait_id' => $forfaits->random()->id,
                    'statut' => $statuts[array_rand($statuts)],
                ]);
                $totalPubs++;
            }
        }

        // 2️⃣ Compléter jusqu'à 50 pubs
        while ($totalPubs < 50) {
            $media = $medias->random();
            $annonceur = $annonceurs->random();
            Publicite::create([
                'annonceur_id' => $annonceur->id,
                'titre' => "Pub extra pour {$media->nom_du_media}",
                'type_media' => 'image',
                'media_path' => $fichier,
                'url_cible' => 'https://example.com',
                'forfait_id' => $forfaits->random()->id,
                'statut' => $statuts[array_rand($statuts)],
            ]);
            $totalPubs++;
        }
    }
}
