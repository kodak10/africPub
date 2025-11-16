<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoriquePaiement extends Model
{
    use SoftDeletes;

    protected $table = 'historique_paiements';

    protected $fillable = [
        'media_id',
        'publicite_id',
        'montant',
        'type',
        'statut',
        'date_paiement',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function publicite()
    {
        return $this->belongsTo(Publicite::class);
    }
}
