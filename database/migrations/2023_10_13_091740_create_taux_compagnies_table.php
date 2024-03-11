<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTauxCompagniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taux_compagnies', function (Blueprint $table) {
            $table->bigIncrements('id_tauxcomp');
            $table->uuid('uuidTauxCompagnie');
            $table->uuid('uuidCompagnie');
            $table->uuid('uuidBranche');

            $table->foreignId('id_compagnie');
            $table->foreign('id_compagnie')
                ->references('id_compagnie')
                ->on('compagnies')
                ->onDelete('cascade');

            $table->foreignId('id_branche');
            $table->foreign('id_branche')
                ->references('id_branche')
                ->on('branches')
                ->onDelete('cascade');

            $table->integer('tauxcomp');
            $table->boolean('sync')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taux_compagnies');
    }
}
