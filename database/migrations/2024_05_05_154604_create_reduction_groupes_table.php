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
        Schema::create('reduction_groupes', function (Blueprint $table) {
            $table->bigIncrements('id_reductions');
            $table->uuid('uuidReductionGroupe');
            $table->uuid('uuidCompagnie');

            $table->foreignId('id_compagnie');
            $table->foreign('id_compagnie')
                ->references('id_compagnie')
                ->on('compagnies')
                ->onDelete('cascade');
            $table->integer('nbrePersonneMin');
            $table->integer('nbrePersonneMax');
            $table->integer('pourcentage');
            $table->boolean('sync')->default(false);

            $table->foreignId('id_entreprise');
            $table->unsignedBigInteger('user_id');

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
        Schema::dropIfExists('reduction_groupes');
    }
};
