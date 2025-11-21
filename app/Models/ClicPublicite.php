<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClicPublicite extends Model
{

    protected $table = 'clics_publicites';

    protected $fillable = [
        'publicite_id',
        'media_id',
        'visiteur_ip',
        'navigateur',
        'empreinte_visiteur',
        'referer',
        'date_clic',
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
