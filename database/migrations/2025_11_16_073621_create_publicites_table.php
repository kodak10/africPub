<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publicites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonceur_id')->constrained('annonceurs')->onDelete('cascade');
            $table->string('titre');
            $table->enum('type_media',['image','video']);
            $table->string('media_path'); // chemin fichier media
            $table->string('url_cible');
            $table->foreignId('forfait_id')->constrained('forfaits')->onDelete('cascade');
            $table->enum('statut', ['brouillon', 'en_attente_paiement', 'en_attente_validation', 'approuve', 'rejete', 'validé', 'suspendu'])->default('brouillon');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicites');
    }
};
