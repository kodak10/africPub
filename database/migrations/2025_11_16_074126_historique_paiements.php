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
        Schema::create('historique_paiements', function(Blueprint $table){
            $table->id();
            $table->foreignId('media_id')->constrained('medias')->onDelete('cascade');
            $table->foreignId('publicite_id')->nullable()->constrained('publicites')->onDelete('set null'); // pour audit
            $table->decimal('montant',10,2);
            $table->enum('type',['vues','clics','forfait'])->default('forfait');
            $table->enum('statut',['paye','annule']);
            $table->timestamp('date_paiement');
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
