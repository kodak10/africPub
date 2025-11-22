<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaiementMedia extends Model
{
    protected $table = 'paiement_medias';

    protected $fillable = [
        'media_id',
        'demande_paiement_id',
        'montant',
        'methode_paiement',
        'numero_telephone',
        'reference_transaction',
        'statut',
        'preuve_paiement',
        'date_paiement'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_paiement' => 'datetime'
    ];

    // Statuts possibles
    const STATUT_INITIE = 'initie';
    const STATUT_COMPLET = 'complet';
    const STATUT_ECHEC = 'echec';
    const STATUT_ATTENTE_CONFIRMATION = 'en_attente_confirmation';

    // Méthodes de paiement
    const METHODE_ORANGE = 'orange_money';
    const METHODE_MTN = 'mtn_money';
    const METHODE_WAVE = 'wave';
    const METHODE_VIREMENT = 'virement_bancaire';
    const METHODE_ESPECES = 'especes';

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function demandePaiement()
    {
        return $this->belongsTo(DemandePaiement::class);
    }

    // Générer une référence de transaction
    public static function genererReference()
    {
        return 'PM-' . time() . '-' . rand(1000, 9999);
    }

    // Accessor pour le montant formaté
    public function getMontantFormateAttribute()
    {
        return number_format($this->montant, 2, ',', ' ') . ' FCFA';
    }

    // Scope pour les paiements complets
    public function scopeComplets($query)
    {
        return $query->where('statut', self::STATUT_COMPLET);
    }

    // Scope pour les paiements en attente
    public function scopeEnAttente($query)
    {
        return $query->where('statut', self::STATUT_ATTENTE_CONFIRMATION);
    }
}