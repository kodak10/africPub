<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forfait extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'libelle',
        'montant',
        'objectif_vues',
        'description',
        'type',
    ];

    public function publicites()
    {
        return $this->hasMany(Publicite::class);
    }
}
