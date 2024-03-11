<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->bigIncrements('id_prospect');
            $table->uuid('uuidProspect');
            $table->string('civilite');
            $table->string('nom_prospect');
            $table->string('postal_prospect')->nullable();
            $table->string('adresse_prospect');
            $table->string('tel_prospect');
            $table->string('profession_prospect');
            $table->string('fax_prospect')->nullable();
            $table->string('email_prospect')->nullable();
            $table->string('etat')->default(0);
            $table->string('statut')->nullable();
            $table->boolean('sync')->default(false);
            $table->string('supprimer_prospect')->comment('0 = encours, 1 = supprimé')->default(0);
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
        Schema::dropIfExists('prospects');
    }
}
