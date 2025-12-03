<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publicite;
use App\Models\Annonceur;
use App\Models\Forfait;
use Illuminate\Support\Facades\DB;

class PublicitesSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Désactiver temporairement les contraintes FK pour vider la table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Publicite::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $forfaits   = Forfait::all();
        $annonceurs = Annonceur::where('statut', 'validé')->get();
        $fichier    = 'publicites/image.jpg';

        if ($annonceurs->isEmpty() || $forfaits->isEmpty()) {
            $this->command->info("Aucun annonceur ou forfait valide. Seeder terminé.");
            return;
        }

        $statut = 'en_attente_paiement'; // toutes les pubs sont à payer
        $totalPubs = 0;

        // Créer 4 à 5 pubs par annonceur
        foreach ($annonceurs as $annonceur) {
            $nbPubs = rand(4, 5);

            for ($i = 1; $i <= $nbPubs; $i++) {
                Publicite::create([
                    'annonceur_id' => $annonceur->id,
                    'titre'        => "Pub {$i} pour {$annonceur->nom}",
                    'type_media'   => 'image',
                    'media_path'   => $fichier,
                    'url_cible'    => 'https://example.com',
                    'forfait_id'   => $forfaits->random()->id,
                    'statut'       => $statut,
                ]);
                $totalPubs++;
            }
        }
    }
}
