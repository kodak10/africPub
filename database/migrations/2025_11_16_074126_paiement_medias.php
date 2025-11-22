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
        Schema::create('paiement_medias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->constrained('medias')->onDelete('cascade');
            $table->foreignId('demande_paiement_id')->constrained('demandes_paiement'); // Lien vers la demande
            $table->decimal('montant', 10, 2);
            $table->enum('methode_paiement', ['orange_money', 'mtn_money', 'wave', 'virement_bancaire', 'especes']);
            $table->string('numero_telephone');
            $table->string('reference_transaction')->unique();
            $table->enum('statut', ['initie', 'complet', 'echec', 'en_attente_confirmation']);
            $table->text('preuve_paiement')->nullable(); // Screenshot, reçu
            $table->timestamp('date_paiement');
            $table->timestamps();
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
