<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandePaiement extends Model
{
    use SoftDeletes;

    protected $table = 'demandes_paiement';

    protected $fillable = [
        'media_id',
        'montant',
        'statut',
        'raison_fraude'
    ];

    // Statuts possibles
    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_PAYE = 'paye';
    const STATUT_REJETE = 'rejete';

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function paiementMedia()
    {
        return $this->hasOne(PaiementMedia::class);
    }

    // ACCESSEURS pour calculer les données à la volée
    public function getVuesTotalAttribute()
    {
        return $this->media->total_vues ?? 0;
    }

    public function getClicsTotalAttribute()
    {
        return $this->media->total_clics ?? 0;
    }

    public function getTauxConversionAttribute()
    {
        $vues = $this->vues_total;
        $clics = $this->clics_total;
        
        return $vues > 0 ? ($clics / $vues) * 100 : 0;
    }

    public function getFraudeDetecteeAttribute()
    {
        return !empty($this->raison_fraude);
    }

    // Détection de fraude simple
    public function detecterFraude()
    {
        $vues = $this->vues_total;
        $clics = $this->clics_total;
        $tauxConversion = $this->taux_conversion;

        $raison = null;

        // Taux de conversion anormalement élevé
        if ($tauxConversion > 50) {
            $raison = 'Taux de conversion anormalement élevé';
        }
        // Vues/clics très rapides
        elseif ($vues > 10000 && $tauxConversion < 0.1) {
            $raison = 'Volume élevé avec faible engagement';
        }
        // Vues sans clics
        elseif ($vues > 5000 && $clics == 0) {
            $raison = 'Volume élevé de vues sans aucun clic';
        }

        if ($raison) {
            $this->update(['raison_fraude' => $raison]);
            return true;
        }

        return false;
    }

    // Accessor pour formater le taux de conversion
    public function getTauxConversionFormateAttribute()
    {
        return number_format($this->taux_conversion, 2) . '%';
    }

    // Accessor pour formater le montant
    public function getMontantFormateAttribute()
    {
        return number_format($this->montant, 2, ',', ' ') . ' FCFA';
    }

    // Méthode pour créer une demande (simplifiée)
    public function initialiserDemande()
    {
        // La détection de fraude se fera automatiquement via l'accesseur
        $this->detecterFraude();
        return $this;
    }
}