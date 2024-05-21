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
        Schema::create('tarification_accidents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuidTarificationAccident');
            $table->uuid('uuidCompagnie');
            $table->uuid('uuidProspect');
            $table->string('nom_complet');
            $table->string('activite');
            $table->integer('effectif');
            $table->integer('duree');

            $table->decimal('deces', 10, 2);
            $table->decimal('ipt', 10, 2);
            $table->decimal('frais_medicaux', 10, 2);
            $table->decimal('prime_nette_brute', 10, 2);
            $table->integer('taux_reduction_effectif');
            $table->decimal('prime_nette_reduite', 10, 2);
            $table->decimal('prime_nette_annuelle', 10, 2);
            $table->decimal('accessoire_annuel', 10, 2);
            $table->decimal('taxe_annuelle', 10, 2);
            $table->decimal('prime_ttc_annuelle', 10, 2);
            $table->decimal('prime_nette_courte', 10, 2);
            $table->integer('taux_reduction_duree');
            $table->decimal('accesoire_courte', 10, 2);
            $table->decimal('taxe_courte', 10, 2);
            $table->decimal('prime_ttc_courte', 10, 2);

            $table->foreignId('id_prospect');
            $table->foreign('id_prospect')
                ->references('id_prospect')
                ->on('prospects')
                ->onDelete('cascade');

            $table->foreignId('id_compagnie');
            $table->foreign('id_compagnie')
                ->references('id_compagnie')
                ->on('compagnies')
                ->onDelete('cascade');

            $table->string('sync')->default(false);
            $table->foreignId('id_entreprise');
            $table->foreignId('user_id');

            $table->foreign('id_entreprise')
                ->references('id_entreprise')
                ->on('entreprises')
                ->onDelete('cascade');



            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarification_accidents');
    }
};
