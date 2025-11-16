<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;
    protected $table = 'medias';

    protected $fillable = [
        'user_id',
        'nom_du_media',
        'url_site',
        'media_token',
        'total_vues',
        'total_clics',
        'revenu_actuel',
        'paiement_demande',
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

    public function historiquePaiements()
    {
        return $this->hasMany(HistoriquePaiement::class);
    }
}
