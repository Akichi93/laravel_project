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
        Schema::create('tarificateur_accidents', function (Blueprint $table) {
            $table->bigIncrements('id_tarificateuria');
            $table->uuid('uuidTarificateurAccident');
            $table->uuid('uuidActivite');
            $table->uuid('uuidCompagnie');


            $table->decimal('tauxDeces', 4, 1);
            $table->decimal('tauxIPT', 4, 1);
            $table->decimal('cent', 10, 1);
            $table->decimal('deuxCent', 10, 1);
            $table->decimal('quatreCent', 10, 1);
            $table->decimal('cinqCent', 10, 1);
            $table->foreignId('id_activite');
            $table->foreignId('id_entreprise');
            $table->foreignId('user_id');

            $table->foreign('id_activite')
                ->references('id_activite')
                ->on('activites')
                ->onDelete('cascade');

            $table->foreignId('id_compagnie');
            $table->foreign('id_compagnie')
                ->references('id_compagnie')
                ->on('compagnies')
                ->onDelete('cascade');

            $table->foreign('id_entreprise')
                ->references('id_entreprise')
                ->on('entreprises')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('sync')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarificateur_accidents');
    }
};
