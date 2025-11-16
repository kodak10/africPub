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
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
