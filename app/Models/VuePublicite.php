<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VuePublicite extends Model
{

    protected $table = 'vues_publicites';

    protected $fillable = [
        'publicite_id',
        'media_id',
        'visiteur_ip',
        'navigateur',
        'empreinte_visiteur',
        'referer',
        'date_vue',
    ];

    protected $casts = [
        'date_vue' => 'datetime'
    ];

    public function publicite()
    {
        return $this->belongsTo(Publicite::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
