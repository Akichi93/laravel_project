<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id_salarie');
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe')->nullable();
            $table->date('date_naissance');
            $table->string('secteur');
            $table->string('renumeration');
            $table->date('date_embauche')->nullable();
            $table->integer('etat')->default(0);
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
        Schema::dropIfExists('salaries');
    }
}
