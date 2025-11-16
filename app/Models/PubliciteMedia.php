<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PubliciteMedia extends Model
{
    use SoftDeletes;

    protected $table = 'publicite_media';

    protected $fillable = [
        'publicite_id',
        'media_id',
        'status',
        'vues_restantes',
        'ordre_priorite',
        'date_expiration',
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
