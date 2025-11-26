<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forfait;
use Illuminate\Support\Facades\DB;

class ForfaitsSeeder extends Seeder
{
    public function run(): void
    {
        // -------------------------------
        // 🎨 FORFAITS IMAGE
        // -------------------------------
        $forfaitsImage = [
            ['Standard', 50000.00, 20000, 15000],
            ['Premium', 100000.00, 40000, 25000],
            ['Gold', 250000.00, 125000, 75000],
            ['Platinum', 500000.00, 300000, 150000],
            ['Diamond', 1000000.00, 700000, 350000],
        ];

        foreach ($forfaitsImage as $f) {
            Forfait::create([
                'libelle' => "Image - {$f[0]}",
                'type' => 'Image',
                'montant' => $f[1],
                'objectif_vues' => $f[2],
                'description' => "Forfait Image {$f[0]} comprenant {$f[2]} vues et {$f[3]} clics.",
            ]);
        }

        // -------------------------------
        // 🎥 FORFAITS VIDEO
        // -------------------------------
        $forfaitsVideo = [
            ['Standard', 100000.00, 35000, 25000],
            ['Premium', 250000.00, 100000, 75000],
            ['Gold', 500000.00, 220000, 150000],
            ['Platinum', 1000000.00, 500000, 350000],
            ['Diamond', 2000000.00, 1200000, 650000],
        ];

        foreach ($forfaitsVideo as $f) {
            Forfait::create([
                'libelle' => "Vidéo - {$f[0]}",
                'type' => 'Video',
                'montant' => $f[1],
                'objectif_vues' => $f[2],
                'description' => "Forfait Vidéo {$f[0]} comprenant {$f[2]} vues et {$f[3]} clics.",
            ]);
        }
    }
}
