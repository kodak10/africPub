<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use App\Models\Publicite;
use App\Models\HistoriquePaiement;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HistoriquePaiementsSeeder extends Seeder
{
    public function run(): void
    {
        $medias = Media::all();
        $publicites = Publicite::all();
        $types = ['vues', 'clics', 'forfait'];
        $statuts = ['paye', 'annule'];

        foreach ($medias as $media) {
            // Chaque media peut avoir 1 à 5 paiements
            $nbPaiements = rand(1, 5);

            for ($i = 0; $i < $nbPaiements; $i++) {
                HistoriquePaiement::create([
                    'media_id' => $media->id,
                    'publicite_id' => rand(0,1) ? $publicites->random()->id : null,
                    'montant' => rand(1000, 10000),
                    'type' => $types[array_rand($types)],
                    'statut' => $statuts[array_rand($statuts)],
                    'date_paiement' => Carbon::now()->subDays(rand(0, 30))->subHours(rand(0,23)),
                ]);
            }
        }
    }
}
