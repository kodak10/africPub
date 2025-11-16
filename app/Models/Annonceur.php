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
        'actif',
    ];

    public function publicites()
    {
        return $this->hasMany(Publicite::class, 'annonceur_id');
    }
}
