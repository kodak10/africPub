<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Annonceur;
use App\Models\Forfait;
use App\Models\PaiementAnnonceur;
use App\Models\Publicite;
use Illuminate\Support\Str;

class PaiementAnnonceursSeeder extends Seeder
{
    public function run(): void
    {
        $annonceurs = Annonceur::where('statut', 'validé')->get();
        $forfaits = Forfait::all();

        if ($annonceurs->isEmpty() || $forfaits->isEmpty()) {
            $this->command->info("Aucun annonceur ou forfait disponible. Seeder terminé.");
            return;
        }

        foreach ($annonceurs as $annonceur) {
            // Simuler 1 à 3 paiements
            $nombrePaiements = rand(1, 3);

            for ($i = 0; $i < $nombrePaiements; $i++) {
                $forfait = $forfaits->random();

                $paiement = PaiementAnnonceur::create([
                    'annonceur_id' => $annonceur->id,
                    'forfait_id' => $forfait->id,
                    'montant' => $forfait->montant,
                    'numero_facture' => 'FA' . strtoupper(Str::random(8)),
                    'methode_paiement' => ['carte_credit', 'virement_bancaire', 'mobile_money', 'paypal'][array_rand(['carte_credit', 'virement_bancaire', 'mobile_money', 'paypal'])],
                    'reference_paiement' => null,
                    'statut' => 'paye',
                    'notes' => "Paiement généré automatiquement pour test.",
                ]);

                // ✅ Mettre à jour toutes les pubs "en_attente_paiement" de cet annonceur vers "en_attente_validation"
                Publicite::where('annonceur_id', $annonceur->id)
                    ->where('statut', 'en_attente_paiement')
                    ->update(['statut' => 'en_attente_validation']);
            }
        }
    }
}
