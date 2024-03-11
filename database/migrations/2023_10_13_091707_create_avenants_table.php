<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avenants', function (Blueprint $table) {
            $table->bigIncrements('id_avenant');
            $table->uuid('uuidAvenant')->nullable();
            $table->uuid('uuidContrat');

            $table->foreignId('id_contrat');
            $table->foreign('id_contrat')
                ->references('id_contrat')
                ->on('contrats')
                ->onDelete('cascade');

            $table->uuid('uuidCompagnie')->nullable();
            $table->uuid('uuidApporteur')->nullable();
            $table->string('annee')->nullable();
            $table->string('mois')->nullable();
            $table->string('type')->nullable();
            $table->string('prime_ttc')->nullable();
            $table->string('retrocession')->nullable();
            $table->string('commission')->nullable();
            $table->string('commission_courtier')->nullable();
            $table->string('prise_charge')->nullable();
            $table->string('ristourne')->nullable();
            $table->string('prime_nette')->nullable();
            $table->date('date_emission')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->string('accessoires')->nullable();
            $table->string('frais_courtier')->nullable();
            $table->string('cfga')->nullable();
            $table->string('taxes_totales')->nullable();
            $table->string('supprimer_avenant')->comment('0 = encours, 1 = supprimé')->default(0);
            $table->string('code_avenant')->nullable();
            $table->string('solder')->default(0);
            $table->string('reverser')->default(0);
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
        Schema::dropIfExists('avenants');
    }
}
