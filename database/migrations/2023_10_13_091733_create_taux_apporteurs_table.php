<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTauxApporteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taux_apporteurs', function (Blueprint $table) {
            $table->bigIncrements('id_tauxapp');
            $table->uuid('uuidTauxApporteur');
            $table->uuid('uuidApporteur');
            $table->uuid('uuidBranche');

            $table->foreignId('id_apporteur');
            $table->foreign('id_apporteur')
                ->references('id_apporteur')
                ->on('apporteurs')
                ->onDelete('cascade');

            $table->foreignId('id_branche');
            $table->foreign('id_branche')
                ->references('id_branche')
                ->on('branches')
                ->onDelete('cascade');

            $table->integer('taux');
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
        Schema::dropIfExists('taux_apporteurs');
    }
}
