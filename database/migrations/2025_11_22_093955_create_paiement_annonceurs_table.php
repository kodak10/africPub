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
        Schema::create('paiement_annonceurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonceur_id')->constrained('annonceurs')->onDelete('cascade');
            $table->foreignId('forfait_id')->constrained('forfaits')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->string('numero_facture')->unique();
            $table->enum('methode_paiement', ['carte_credit', 'virement_bancaire', 'mobile_money', 'paypal']);
            $table->string('reference_paiement')->nullable();
            $table->enum('statut', ['en_attente', 'paye', 'echec', 'rembourse'])->default('en_attente');
            $table->date('date_echeance');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement_annonceurs');
    }
};
