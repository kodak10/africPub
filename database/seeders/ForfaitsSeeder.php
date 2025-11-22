<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forfait;

class ForfaitsSeeder extends Seeder
{
    public function run(): void
    {
        // Tarifs pour les forfaits Image
        $forfaitsImage = [
            [50000.00, 20000, 15000],    // 50.000f -> 50000.00
            [100000.00, 40000, 25000],   // 100.000f -> 100000.00
            [250000.00, 125000, 75000],  // 250.000f -> 250000.00
            [500000.00, 300000, 150000], // 500.000f -> 500000.00
            [1000000.00, 700000, 350000],// 1.000.000f -> 1000000.00
        ];

        // Forfaits Image
        foreach ($forfaitsImage as $f) {
            Forfait::create([
                'libelle' => "Image - {$f[0]}",
                'montant' => $f[0],  // Montant
                'type' => 'Image',    // Type forfait
                'objectif_vues' => $f[1],  // Objectif vues
                'description' => "Forfait Image - {$f[0]} : {$f[1]} vues et {$f[2]} clics",  // Description
            ]);
        }

        // Tarifs pour les forfaits Vidéo
        $forfaitsVideo = [
            [100000.00, 35000, 25000],    // 100.000f -> 100000.00
            [250000.00, 100000, 75000],   // 250.000f -> 250000.00
            [500000.00, 220000, 150000],  // 500.000f -> 500000.00
            [1000000.00, 500000, 350000], // 1.000.000f -> 1000000.00
        ];

        // Forfaits Vidéo
        foreach ($forfaitsVideo as $f) {
            Forfait::create([
                'libelle' => "Vidéo - {$f[0]}",
                'montant' => $f[0],  // Montant
                'type' => 'Video',    // Type forfait
                'objectif_vues' => $f[1],  // Objectif vues
                'description' => "Forfait Vidéo - {$f[0]} : {$f[1]} vues et {$f[2]} clics",  // Description
            ]);
        }
    }
}
