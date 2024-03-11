<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinistresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinistres', function (Blueprint $table) {
            $table->bigIncrements('id_sinistre');
            $table->uuid('uuidSinistre');

            $table->unsignedBigInteger('id_contrat');
            $table->foreign('id_contrat')
                ->references('id_contrat')
                ->on('contrats')
                ->onDelete('cascade');

            $table->date('date_survenance')->nullable();
            $table->time('heure')->nullable();
            $table->string('date_declaration')->nullable();
            $table->string('date_ouverture')->nullable();
            $table->string('date_decla_compagnie')->nullable();
            $table->string('numero_sinistre')->nullable();
            $table->string('reference_compagnie')->nullable();
            $table->string('gestion_compagnie')->nullable();
            $table->string('materiel_sinistre')->nullable();
            $table->string('ipp')->nullable();
            $table->string('garantie_applique')->nullable();
            $table->string('recours_sinistre')->nullable();
            $table->date('date_mission')->nullable();
            $table->string('accident_sinistre')->nullable();
            $table->string('lieu_sinistre')->nullable();
            $table->string('expert')->nullable();
            $table->longText('commentaire_sinistre')->nullable();
            $table->integer('etat')->comment('0 = encours, 2 = terminer')->default(0);
            $table->string('supprimer_sinistre')->comment('0 = encours, 1 = supprimé')->default(0);
            $table->string('sinistre_url')->nullable();
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
        Schema::dropIfExists('sinistres');
    }
}
