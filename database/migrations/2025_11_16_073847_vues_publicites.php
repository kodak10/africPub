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
        Schema::create('vues_publicites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicite_id')->constrained('publicites')->onDelete('cascade');
            $table->foreignId('media_id')->constrained('medias')->onDelete('cascade');
            $table->string('visiteur_ip',45);
            $table->string('navigateur')->nullable();
            $table->string('empreinte_visiteur'); // hash unique visiteur
            $table->string('referer')->nullable();
            $table->timestamp('date_vue');
            $table->timestamps();
            $table->unique(
                    ['publicite_id','media_id','empreinte_visiteur','date_vue'],
                    'vue_pub_unique'
                );
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
