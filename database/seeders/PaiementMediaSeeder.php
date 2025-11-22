<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaiementMedia;
use App\Models\HistoriquePaiementMedia;
use App\Models\DemandePaiement;
use App\Models\Media;

class PaiementMediaSeeder extends Seeder
{
    public function run()
    {
        // Récupérer les médias avec des demandes de paiement
        $medias = Media::has('demandesPaiement')->with('demandesPaiement')->limit(10)->get();

        if ($medias->isEmpty()) {
            $this->command->info('Aucun média avec demande de paiement trouvé. Veuillez d\'abord créer des demandes de paiement.');
            return;
        }

        foreach ($medias as $media) {
            foreach ($media->demandesPaiement as $demande) {
                $paiement = PaiementMedia::create([
                    'media_id' => $media->id,
                    'demande_paiement_id' => $demande->id,
                    'montant' => $demande->montant,
                    'methode_paiement' => $this->getMethodeAleatoire(),
                    'numero_telephone' => $media->telephone,
                    'reference_transaction' => PaiementMedia::genererReference(),
                    'statut' => $this->getStatutAleatoire(),
                    'preuve_paiement' => rand(0, 1) ? 'screenshot_paiement_' . $demande->id . '.jpg' : null,
                    'date_paiement' => now()->subDays(rand(1, 15))
                ]);

                // Mettre à jour le statut de la demande si le paiement est complet
                if ($paiement->statut === PaiementMedia::STATUT_COMPLET) {
                    $demande->update(['statut' => DemandePaiement::STATUT_PAYE]);
                }

            }
        }

    }

    private function getMethodeAleatoire()
    {
        $methodes = [
            PaiementMedia::METHODE_ORANGE,
            PaiementMedia::METHODE_MTN,
            PaiementMedia::METHODE_WAVE,
            PaiementMedia::METHODE_VIREMENT,
            PaiementMedia::METHODE_ESPECES
        ];
        return $methodes[array_rand($methodes)];
    }

    private function getStatutAleatoire()
    {
        $statuts = [
            PaiementMedia::STATUT_COMPLET,
            PaiementMedia::STATUT_ATTENTE_CONFIRMATION,
            PaiementMedia::STATUT_INITIE,
            PaiementMedia::STATUT_ECHEC
        ];
        return $statuts[array_rand($statuts)];
    }

}