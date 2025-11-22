<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandeRemboursementAnnonceur extends Model
{
    use SoftDeletes;

    protected $table = 'demandes_remboursement';

    protected $fillable = [
        'annonceur_id',
        'paiement_annonceur_id',
        'montant',
        'raison',
        'preuves',
        'statut',
        'raison_rejet',
        'date_remboursement',
        'reference_remboursement',
        'methode_remboursement'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'preuves' => 'array',
        'date_remboursement' => 'datetime'
    ];

    // Statuts possibles
    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_APPROUVE = 'approuve';
    const STATUT_REJETE = 'rejete';
    const STATUT_REMBOURSE = 'rembourse';

    // Méthodes de remboursement
    const METHODE_VIREMENT = 'virement_bancaire';
    const METHODE_CARTE = 'carte_credit';
    const METHODE_CHEQUE = 'cheque';
    const METHODE_CREDIT = 'credit_plateforme';

    public function annonceur()
    {
        return $this->belongsTo(Annonceur::class);
    }

    public function paiementAnnonceur()
    {
        return $this->belongsTo(PaiementAnnonceur::class);
    }

    // Accesseurs
    public function getMontantFormateAttribute()
    {
        return number_format($this->montant, 2, ',', ' ') . ' FCFA';
    }

    public function getStatutLibelleAttribute()
    {
        $libelles = [
            self::STATUT_EN_ATTENTE => 'En attente',
            self::STATUT_APPROUVE => 'Approuvé',
            self::STATUT_REJETE => 'Rejeté',
            self::STATUT_REMBOURSE => 'Remboursé'
        ];

        return $libelles[$this->statut] ?? $this->statut;
    }

    public function getMethodeRemboursementLibelleAttribute()
    {
        $libelles = [
            self::METHODE_VIREMENT => 'Virement Bancaire',
            self::METHODE_CARTE => 'Carte de Crédit',
            self::METHODE_CHEQUE => 'Chèque',
            self::METHODE_CREDIT => 'Crédit Plateforme'
        ];

        return $libelles[$this->methode_remboursement] ?? $this->methode_remboursement;
    }

    // Méthodes métier
    public function peutEtreRembourse()
    {
        return $this->statut === self::STATUT_APPROUVE;
    }

    public function estEnAttente()
    {
        return $this->statut === self::STATUT_EN_ATTENTE;
    }

    // Générer une référence de remboursement
    public static function genererReference()
    {
        return 'REM-ANN-' . time() . '-' . rand(1000, 9999);
    }

    // Créer une entrée d'historique
    public function creerEntreeHistorique($action, $details = '', $metadata = null)
    {
        return $this->historique()->create([
            'action' => $action,
            'details' => $details,
            'metadata' => $metadata,
            'date_action' => now()
        ]);
    }
}