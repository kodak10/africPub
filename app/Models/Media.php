<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Media extends Model
{
    use SoftDeletes;
    
    protected $table = 'medias';

    protected $fillable = [
        'user_id',
        'nom_du_media',
        'url_site',
        'numero_rccm',
        'telephone',
        'email',
        'logo_media',
        'adresse',
        'description',
        'media_token',
        'total_vues',
        'total_clics',
        'revenu_actuel',
        'paiement_demande',
        'statut',
    ];

    protected $casts = [
        'total_vues' => 'integer',
        'total_clics' => 'integer',
        'revenu_actuel' => 'decimal:2',
        'paiement_demande' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publicites()
    {
        return $this->belongsToMany(Publicite::class, 'publicite_media')
            ->withPivot(['status','vues_restantes','ordre_priorite','date_expiration'])
            ->withTimestamps();
    }

    public function getPublicitesActivesAttribute()
    {
        return $this->publicites()->wherePivot('status', 'active')->get();
    }

    public function vues()
    {
        return $this->hasMany(VuePublicite::class);
    }

    public function clics()
    {
        return $this->hasMany(ClicPublicite::class);
    }

    public function demandesPaiement()
    {
        return $this->hasMany(DemandePaiement::class);
    }

    // CORRECTION : Relation avec PaiementMedia au lieu de HistoriquePaiementMedia
    public function paiementsMedia()
    {
        return $this->hasMany(PaiementMedia::class);
    }

    public function demandesPaiementEnAttente()
    {
        return $this->hasMany(DemandePaiement::class)->where('statut', DemandePaiement::STATUT_EN_ATTENTE);
    }

    // NOUVELLE MÉTHODE : Obtenir les paiements complétés
    public function paiementsComplets()
    {
        return $this->paiementsMedia()->where('statut', PaiementMedia::STATUT_COMPLET);
    }

    // NOUVELLE MÉTHODE : Obtenir les paiements en attente
    public function paiementsEnAttente()
    {
        return $this->paiementsMedia()->where('statut', PaiementMedia::STATUT_ATTENTE_CONFIRMATION);
    }

    public function creerDemandePaiement()
    {
        // Vérifier qu'il y a des vues ou clics à payer
        if ($this->total_vues == 0 && $this->total_clics == 0) {
            throw new \Exception('Aucune vue ou clic à payer pour ce média.');
        }

        // Calcul du montant basé sur les vues/clics actuels
        $montant = ($this->total_vues * 0.001) + ($this->total_clics * 0.01);
        
        // Création de la demande
        $demande = $this->demandesPaiement()->create([
            'montant' => $montant,
            'statut' => DemandePaiement::STATUT_EN_ATTENTE,
            'raison_fraude' => null
        ]);

        // Marquer que le média a une demande de paiement en cours
        $this->update(['paiement_demande' => true]);

        // Initialisation avec détection de fraude
        return $demande->initialiserDemande();
    }

    public function reinitialiserCompteurs()
    {
        $this->update([
            'total_vues' => 0,
            'total_clics' => 0,
            'revenu_actuel' => 0,
            'paiement_demande' => false
        ]);
    }

    // NOUVELLE MÉTHODE : Obtenir le total des paiements reçus
    public function getTotalPaiementsRecusAttribute()
    {
        return $this->paiementsComplets()->sum('montant');
    }

    // NOUVELLE MÉTHODE : Obtenir le dernier paiement
    public function getDernierPaiementAttribute()
    {
        return $this->paiementsComplets()->latest()->first();
    }

    // NOUVELLE MÉTHODE : Vérifier si le média a des paiements en cours
    public function getAPaiementEnCoursAttribute()
    {
        return $this->paiementsMedia()
            ->whereIn('statut', [PaiementMedia::STATUT_INITIE, PaiementMedia::STATUT_ATTENTE_CONFIRMATION])
            ->exists();
    }

    // Méthode pour obtenir les statistiques actuelles
    public function getStatistiquesAttribute()
    {
        $tauxConversion = $this->total_vues > 0 ? 
            ($this->total_clics / $this->total_vues) * 100 : 0;

        return [
            'vues' => $this->total_vues,
            'clics' => $this->total_clics,
            'taux_conversion' => number_format($tauxConversion, 2),
            'revenu_estime' => ($this->total_vues * 0.001) + ($this->total_clics * 0.01),
            'total_paiements_recus' => $this->total_paiements_recus,
            'dernier_paiement' => $this->dernier_paiement ? $this->dernier_paiement->date_paiement->format('d/m/Y') : 'Aucun'
        ];
    }

    // NOUVELLE MÉTHODE : Obtenir les performances par période
    public function getPerformancesParPeriode($dateDebut, $dateFin)
    {
        $vuesPeriode = $this->vues()
            ->whereBetween('date_vue', [$dateDebut, $dateFin])
            ->distinct('empreinte_visiteur')
            ->count('empreinte_visiteur');

        $clicsPeriode = $this->clics()
            ->whereBetween('date_clic', [$dateDebut, $dateFin])
            ->distinct('empreinte_visiteur')
            ->count('empreinte_visiteur');

        $tauxConversionPeriode = $vuesPeriode > 0 ? ($clicsPeriode / $vuesPeriode) * 100 : 0;

        return [
            'vues' => $vuesPeriode,
            'clics' => $clicsPeriode,
            'taux_conversion' => round($tauxConversionPeriode, 2),
            'revenu_estime' => ($vuesPeriode * 0.001) + ($clicsPeriode * 0.01)
        ];
    }

    // CORRECTION : Détection de fraude avancée avec les données réelles
    public function analyserFraudeAvancee()
    {
        $raisons = [];
        $fraudeDetectee = false;

        // 1. Analyser les patterns de vues (IP suspectes)
        $ipsSuspectes = $this->vues()
            ->select('visiteur_ip', DB::raw('COUNT(*) as count'))
            ->groupBy('visiteur_ip')
            ->having('count', '>', 50)
            ->count();

        if ($ipsSuspectes > 0) {
            $raisons[] = "$ipsSuspectes adresse(s) IP avec plus de 50 vues";
            $fraudeDetectee = true;
        }

        // 2. Analyser les clics trop rapides (bots)
        $clicRapides = $this->clics()
            ->join('vues_publicites', function($join) {
                $join->on('clics_publicites.publicite_id', '=', 'vues_publicites.publicite_id')
                     ->on('clics_publicites.media_id', '=', 'vues_publicites.media_id')
                     ->on('clics_publicites.empreinte_visiteur', '=', 'vues_publicites.empreinte_visiteur');
            })
            ->whereRaw('TIMESTAMPDIFF(SECOND, vues_publicites.date_vue, clics_publicites.date_clic) < 1')
            ->count();

        $totalClics = $this->clics()->count();
        if ($totalClics > 0 && $clicRapides > ($totalClics * 0.3)) {
            $raisons[] = "$clicRapides clics trop rapides (< 1s) sur $totalClics total";
            $fraudeDetectee = true;
        }

        // 3. Vérifier les empreintes de visiteur uniques
        $empreintesUniquesVues = $this->vues()->distinct('empreinte_visiteur')->count();
        $empreintesUniquesClics = $this->clics()->distinct('empreinte_visiteur')->count();

        if ($empreintesUniquesVues > 0 && $this->total_vues / $empreintesUniquesVues < 1.1) {
            $raisons[] = "Taux de vues par visiteur anormalement bas (" . round($this->total_vues / $empreintesUniquesVues, 2) . " vues/visiteur)";
            $fraudeDetectee = true;
        }

        // 4. Vérifier la cohérence vues/clics
        if ($this->total_vues > 1000 && $this->total_clics == 0) {
            $raisons[] = "Volume élevé de vues (" . $this->total_vues . ") sans aucun clic";
            $fraudeDetectee = true;
        }

        // 5. Vérifier les vues sans referer (trafic direct suspect)
        $vuesSansReferer = $this->vues()->whereNull('referer')->orWhere('referer', '')->count();
        if ($vuesSansReferer > ($this->total_vues * 0.8)) { // Plus de 80% sans referer
            $raisons[] = "Taux de trafic direct anormalement élevé ($vuesSansReferer/$this->total_vues vues)";
            $fraudeDetectee = true;
        }

        return [
            'fraude_detectee' => $fraudeDetectee,
            'raisons' => $raisons,
            'ips_suspectes' => $ipsSuspectes,
            'clic_rapides' => $clicRapides,
            'empreintes_uniques_vues' => $empreintesUniquesVues,
            'empreintes_uniques_clics' => $empreintesUniquesClics,
            'vues_sans_referer' => $vuesSansReferer,
            'score_risque' => $this->calculerScoreRisque($fraudeDetectee, count($raisons))
        ];
    }

    // NOUVELLE MÉTHODE : Calculer un score de risque
    private function calculerScoreRisque($fraudeDetectee, $nombreRaisons)
    {
        if (!$fraudeDetectee) {
            return 'Faible';
        }

        if ($nombreRaisons >= 3) {
            return 'Élevé';
        } elseif ($nombreRaisons >= 2) {
            return 'Moyen';
        } else {
            return 'Faible à moyen';
        }
    }

    // NOUVELLE MÉTHODE : Obtenir le solde actuel (revenu non payé)
    public function getSoldeActuelAttribute()
    {
        return ($this->total_vues * 0.001) + ($this->total_clics * 0.01);
    }

    // NOUVELLE MÉTHODE : Vérifier l'éligibilité au paiement
    public function estEligiblePaiement()
    {
        // Minimum 5000 FCFA pour être éligible au paiement
        $montantMinimum = 5000;
        $soldeActuel = $this->solde_actuel;

        return [
            'eligible' => $soldeActuel >= $montantMinimum,
            'solde_actuel' => $soldeActuel,
            'montant_minimum' => $montantMinimum,
            'manquant' => max(0, $montantMinimum - $soldeActuel)
        ];
    }
}