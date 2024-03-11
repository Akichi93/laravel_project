<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompagniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compagnies', function (Blueprint $table) {
            $table->bigIncrements('id_compagnie');
            $table->uuid('uuidCompagnie');
            $table->string('nom_compagnie');
            $table->string('adresse_compagnie')->nullable();
            $table->string('email_compagnie')->nullable();
            $table->string('contact_compagnie')->nullable();
            $table->string('postal_compagnie')->nullable();
            $table->string('code_compagnie')->nullable();
            $table->string('compagnie_url')->nullable();
            $table->boolean('sync')->default(false);
            $table->string('supprimer_compagnie')->comment('0 = encours, 1 = supprimé')->default(0);
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
        Schema::dropIfExists('compagnies');
    }
}
