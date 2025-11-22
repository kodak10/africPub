<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaiementAnnonceur extends Model
{
    use SoftDeletes;

    protected $table = 'paiement_annonceurs';

    protected $fillable = [
        'annonceur_id',
        'forfait_id',
        'montant',
        'numero_facture',
        'methode_paiement',
        'reference_paiement',
        'statut',
        'date_echeance',
        'notes'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_echeance' => 'date'
    ];

    // Statuts possibles
    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_PAYE = 'paye';
    const STATUT_ECHEC = 'echec';
    const STATUT_REMBOURSE = 'rembourse';

    // Méthodes de paiement
    const METHODE_CARTE = 'carte_credit';
    const METHODE_VIREMENT = 'virement_bancaire';
    const METHODE_MOBILE = 'mobile_money';
    const METHODE_PAYPAL = 'paypal';

    public function annonceur()
    {
        return $this->belongsTo(Annonceur::class);
    }

    // Générer un numéro de facture automatique
    public static function genererNumeroFacture()
    {
        $count = static::withTrashed()->count() + 1;
        return 'FACT-' . date('Ymd') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    // Accessor pour le montant formaté
    public function getMontantFormateAttribute()
    {
        return number_format($this->montant, 2, ',', ' ') . ' FCFA';
    }

    // Scope pour les paiements payés
    public function scopePayes($query)
    {
        return $query->where('statut', self::STATUT_PAYE);
    }

    // Scope pour les paiements en attente
    public function scopeEnAttente($query)
    {
        return $query->where('statut', self::STATUT_EN_ATTENTE);
    }

    public function peutEtreRembourse()
    {
        // Un paiement peut être remboursé s'il est payé et n'a pas déjà été remboursé
        return $this->statut === self::STATUT_PAYE && 
               !$this->demandesRemboursement()->whereIn('statut', [
                   DemandeRemboursementAnnonceur::STATUT_APPROUVE, 
                   DemandeRemboursementAnnonceur::STATUT_REMBOURSE
               ])->exists();
    }

    public function forfait()
    {
        return $this->belongsTo(Forfait::class);
    }
}