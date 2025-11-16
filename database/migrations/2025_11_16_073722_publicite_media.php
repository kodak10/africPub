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
        Schema::create('publicite_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicite_id')->constrained('publicites')->onDelete('cascade');
            $table->foreignId('media_id')->constrained('medias')->onDelete('cascade');
            $table->enum('status',['active','suspendue'])->default('active');
            $table->integer('vues_restantes')->default(0); // calculé selon forfait
            $table->integer('ordre_priorite')->default(0); // ordre d'affichage si plusieurs pubs
            $table->dateTime('date_expiration')->nullable(); // fin diffusion
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
