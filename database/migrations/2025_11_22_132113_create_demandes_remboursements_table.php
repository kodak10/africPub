<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demandes_remboursement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonceur_id')->constrained('annonceurs')->onDelete('cascade');
            $table->foreignId('paiement_annonceur_id')->constrained('paiement_annonceurs')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->text('raison');
            $table->text('preuves')->nullable(); // JSON pour stocker les fichiers de preuve
            $table->enum('statut', ['en_attente', 'approuve', 'rejete', 'rembourse'])->default('en_attente');
            $table->text('raison_rejet')->nullable();
            $table->timestamp('date_remboursement')->nullable();
            $table->string('reference_remboursement')->nullable();
            $table->string('methode_remboursement')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes_remboursement');
    }
};