<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forfait;

class ForfaitsSeeder extends Seeder
{
    public function run(): void
    {
        $forfaits = [
            ['Libelle 1', 10000, 1000],
            ['Libelle 2', 50000, 5000],
            ['Libelle 3', 100000, 10000],
        ];

        foreach ($forfaits as $f) {
            Forfait::create([
                'libelle' => $f[0],
                'montant' => $f[1],
                'objectif_vues' => $f[2],
                'description' => "Forfait {$f[0]}",
            ]);
        }
    }
}
