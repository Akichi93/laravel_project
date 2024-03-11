<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->bigIncrements('id_contrat');
            $table->uuid('uuidContrat');

            $table->foreignId('id_branche');

            $table->foreign('id_branche')
                ->references('id_branche')
                ->on('branches')
                ->onDelete('cascade');

            $table->foreignId('id_client');

            $table->foreign('id_client')
                ->references('id_client')
                ->on('clients')
                ->onDelete('cascade');

            $table->foreignId('id_compagnie');

            $table->foreign('id_compagnie')
                ->references('id_compagnie')
                ->on('compagnies')
                ->onDelete('cascade');

            $table->foreignId('id_apporteur');

            $table->foreign('id_apporteur')
                ->references('id_apporteur')
                ->on('apporteurs')
                ->onDelete('cascade');

            $table->string('numero_police');
            $table->date('souscrit_le');
            $table->date('effet_police');
            $table->time('heure_police');
            $table->date('expire_le');
            $table->string('reconduction');
            $table->string('prime_nette')->nullable();
            $table->string('frais_courtier')->nullable();
            $table->string('accessoires')->nullable();
            $table->string('cfga')->nullable();
            $table->string('taxes_totales')->nullable();
            $table->string('primes_ttc')->nullable();
            $table->string('commission_courtier')->nullable();
            $table->string('gestion')->nullable();
            $table->string('commission_apporteur')->nullable();
            $table->string('supprimer_contrat')->comment('0 = encours, 1 = supprimé')->default(0);
            $table->string('contrat_url')->nullable();
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
        Schema::dropIfExists('contrats');
    }
}
