<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publicite;
use App\Models\Media;

class PubliciteMediaSeeder extends Seeder
{
    public function run(): void
    {
        $publicites = Publicite::all();
        $medias = Media::all();

        foreach ($publicites as $pub) {
            foreach ($medias->random(rand(1,2)) as $media) {
                $pub->medias()->attach($media->id, [
                    'status' => rand(0,1) ? 'active' : 'suspendue',
                    'vues_restantes' => rand(100,1000),
                    'ordre_priorite' => rand(0,10),
                    'date_expiration' => now()->addDays(rand(1,30)),
                ]);
            }
        }
    }
}
