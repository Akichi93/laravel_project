<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApporteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apporteurs', function (Blueprint $table) {
            $table->bigIncrements('id_apporteur');
            $table->uuid('uuidApporteur');
            $table->string('nom_apporteur');
            $table->string('email_apporteur')->nullable();
            $table->string('adresse_apporteur');
            $table->string('contact_apporteur')->nullable();
            $table->string('code_apporteur');
            $table->string('code_postal')->nullable();
            $table->string('apporteur_url')->nullable();
            $table->boolean('sync')->default(false);
            $table->string('supprimer_apporteur')->comment('0 = encours, 1 = supprimé')->default(0);
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
        Schema::dropIfExists('apporteurs');
    }
}
