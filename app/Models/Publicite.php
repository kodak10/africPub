<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicite extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'annonceur_id',
        'titre',
        'type_media',
        'fichier',
        'url_cible',
        'forfait_id',
        'statut',
    ];

    public function annonceur()
    {
        return $this->belongsTo(User::class, 'annonceur_id');
    }

    public function forfait()
    {
        return $this->belongsTo(Forfait::class);
    }

    public function medias()
    {
        return $this->belongsToMany(Media::class, 'publicite_media')
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

    public function historiquePaiements()
    {
        return $this->hasMany(HistoriquePaiement::class);
    }
}
