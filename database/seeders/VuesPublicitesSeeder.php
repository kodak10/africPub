<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Publicite;
use App\Models\VuePublicite;
use Illuminate\Database\Seeder;

class VuesPublicitesSeeder extends Seeder
{
    public function run(): void
    {
        $publicites = Publicite::where('statut', 'validé')->get();
        $medias = Media::where('statut', 'validé')->get();

        foreach ($publicites as $pub) {
            $assignedMedias = $pub->medias;
            foreach ($assignedMedias as $media) {
                // Générer 5 à 20 vues aléatoires
                for ($i = 0; $i < rand(5, 20); $i++) {
                    VuePublicite::create([
                        'publicite_id' => $pub->id,
                        'media_id' => $media->id,
                        'visiteur_ip' => '192.168.1.' . rand(1, 254),
                        'navigateur' => 'Chrome',
                        'empreinte_visiteur' => md5(rand(1,10000) . microtime()),
                        'referer' => 'https://example.com',
                        'date_vue' => now()->subMinutes(rand(0, 60)),
                    ]);
                }
            }
        }
    }
}
