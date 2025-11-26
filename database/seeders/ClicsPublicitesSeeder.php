<?php

namespace Database\Seeders;

use App\Models\ClicPublicite;
use App\Models\Publicite;
use Illuminate\Database\Seeder;

class ClicsPublicitesSeeder extends Seeder
{
    public function run(): void
    {
        $publicites = Publicite::where('statut', 'validé')->get();

        foreach ($publicites as $pub) {
            $assignedMedias = $pub->medias;
            foreach ($assignedMedias as $media) {
                // Générer 2 à 10 clics aléatoires
                for ($i = 0; $i < rand(2, 10); $i++) {
                    ClicPublicite::create([
                        'publicite_id' => $pub->id,
                        'media_id' => $media->id,
                        'visiteur_ip' => '192.168.1.' . rand(1, 254),
                        'navigateur' => 'Firefox',
                        'empreinte_visiteur' => md5(rand(1,10000) . microtime()),
                        'referer' => 'https://example.com',
                        'date_clic' => now()->subMinutes(rand(0, 60)),
                    ]);
                }
            }
        }
    }
}
