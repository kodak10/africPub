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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nom_du_media');
            $table->string('url_site');
            $table->string('numero_rccm');
            $table->string('telephone');
            $table->string('email');
            $table->string('logo_media')->nullable();
            $table->string('adresse');
            $table->text('description')->nullable();
            $table->string('media_token')->unique(); // sécurise l'API
            $table->bigInteger('total_vues')->default(0);
            $table->bigInteger('total_clics')->default(0);
            $table->decimal('revenu_actuel',10,2)->default(0);
            $table->boolean('paiement_demande')->default(false);
            $table->enum('statut', ['en attente','validé','suspendu',])->default('en attente');            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
