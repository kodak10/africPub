<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaiementAnnonceur;
use App\Models\HistoriquePaiementAnnonceur;
use App\Models\Annonceur;
use App\Models\Forfait;

class PaiementAnnonceurSeeder extends Seeder
{
    public function run()
    {
        $annonceurs = Annonceur::limit(5)->get();
        $forfaits = Forfait::all();

        if ($annonceurs->isEmpty() || $forfaits->isEmpty()) {
            $this->command->info('Aucun annonceur ou forfait trouvé. Veuillez d\'abord seed les annonceurs et forfaits.');
            return;
        }

        foreach ($annonceurs as $annonceur) {
            $forfait = $forfaits->random();

            $paiement = PaiementAnnonceur::create([
                'annonceur_id' => $annonceur->id,
                'forfait_id' => $forfait->id,
                'montant' => $forfait->montant,
                'numero_facture' => PaiementAnnonceur::genererNumeroFacture(),
                'methode_paiement' => $this->getMethodeAleatoire(),
                'reference_paiement' => 'REF-' . time() . '-' . $annonceur->id,
                'statut' => $this->getStatutAleatoire(),
                'date_echeance' => now()->addDays(rand(5, 30)),
                'notes' => rand(0, 1) ? 'Paiement pour campagne publicitaire' : null
            ]);

        }

    }

    private function getMethodeAleatoire()
    {
        $methodes = [
            PaiementAnnonceur::METHODE_CARTE,
            PaiementAnnonceur::METHODE_VIREMENT,
            PaiementAnnonceur::METHODE_MOBILE,
            PaiementAnnonceur::METHODE_PAYPAL
        ];
        return $methodes[array_rand($methodes)];
    }

    private function getStatutAleatoire()
    {
        $statuts = [
            PaiementAnnonceur::STATUT_EN_ATTENTE,
            PaiementAnnonceur::STATUT_PAYE,
            PaiementAnnonceur::STATUT_ECHEC
        ];
        return $statuts[array_rand($statuts)];
    }

}