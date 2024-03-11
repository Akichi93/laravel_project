<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id_client');
            $table->uuid('uuidClient');
            $table->string('civilite');
            $table->string('nom_client');
            $table->string('postal_client')->nullable();
            $table->string('adresse_client');
            $table->string('tel_client');
            $table->string('profession_client');
            $table->string('fax_client')->nullable();
            $table->string('email_client')->nullable();
            $table->string('numero_client');
            $table->boolean('sync')->default(true);
            $table->string('supprimer_client')->comment('0 = encours, 1 = supprimé')->default(0);
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
        Schema::dropIfExists('clients');
    }
}
