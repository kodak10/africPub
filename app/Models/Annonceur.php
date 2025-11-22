<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Annonceur extends Authenticatable
{
    use HasApiTokens, SoftDeletes, HasRoles;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse',
        'statut',
    ];

    public function publicites()
    {
        return $this->hasMany(Publicite::class, 'annonceur_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paiementsAnnonceur()
    {
        return $this->hasMany(PaiementAnnonceur::class);
    }

    public function demandesRemboursement()
    {
        return $this->hasMany(DemandeRemboursementAnnonceur::class);
    }

    public function demandesRemboursementEnAttente()
    {
        return $this->hasMany(DemandeRemboursementAnnonceur::class)->where('statut', DemandeRemboursementAnnonceur::STATUT_EN_ATTENTE);
    }

    // Méthode pour calculer le solde remboursable
    public function getSoldeRemboursableAttribute()
    {
        return $this->paiementsAnnonceur()
            ->where('statut', PaiementAnnonceur::STATUT_PAYE)
            ->whereDoesntHave('demandesRemboursement', function($query) {
                $query->whereIn('statut', [
                    DemandeRemboursementAnnonceur::STATUT_EN_ATTENTE,
                    DemandeRemboursementAnnonceur::STATUT_APPROUVE,
                    DemandeRemboursementAnnonceur::STATUT_REMBOURSE
                ]);
            })
            ->sum('montant');
    }
}