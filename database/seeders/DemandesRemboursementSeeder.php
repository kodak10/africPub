<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DemandeRemboursementAnnonceur;
use App\Models\Annonceur;
use App\Models\PaiementAnnonceur;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DemandesRemboursementSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $annonceurs = Annonceur::all();
        $paiements = PaiementAnnonceur::all();

        if ($annonceurs->isEmpty() || $paiements->isEmpty()) {
            $this->command->warn('Pas d\'annonceurs ou paiements pour créer des demandes.');
            return;
        }

        foreach (range(1, 20) as $i) {
            $annonceur = $annonceurs->random();
            $paiement = $paiements->where('annonceur_id', $annonceur->id)->random();

            DemandeRemboursementAnnonceur::create([
                'annonceur_id' => $annonceur->id,
                'paiement_annonceur_id' => $paiement->id,
                'montant' => $faker->numberBetween(1000, $paiement->montant),
                'raison' => $faker->paragraph,
                'preuves' => json_encode([
                    $faker->imageUrl(400, 300, 'business'),
                    $faker->imageUrl(400, 300, 'finance')
                ]),
                'statut' => $faker->randomElement(['en_attente', 'approuve', 'rejete', 'rembourse']),
                'raison_rejet' => $faker->optional()->sentence,
                'date_remboursement' => $faker->optional()->dateTimeThisYear,
                'reference_remboursement' => $faker->optional()->bothify('REF-#####'),
                'methode_remboursement' => $faker->optional()->randomElement(['virement_bancaire', 'carte_credit', 'cheque', 'credit_plateforme']),
            ]);
        }
    }
}
