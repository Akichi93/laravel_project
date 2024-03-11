<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automobiles', function (Blueprint $table) {
            $table->bigIncrements('id_automobile');
            $table->uuid('uuidAutomobile');
            $table->uuid('uuidContrat');
            $table->string('numero_immatriculation')->nullable();
            $table->string('identification_proprietaire')->nullable();
            $table->date('date_circulation')->nullable();
            $table->string('adresse_proprietaire')->nullable();
            $table->string('categorie')->nullable();
            $table->string('marque')->nullable();
            $table->string('genre')->nullable();
            $table->string('type')->nullable();
            $table->string('carosserie')->nullable();
            $table->string('couleur')->nullable();
            $table->string('option')->nullable();
            $table->string('entree')->nullable();
            $table->string('energie')->nullable();
            $table->string('place')->nullable();
            $table->string('puissance')->nullable();
            $table->string('charge')->nullable();
            $table->string('valeur_neuf')->nullable();
            $table->string('valeur_venale')->nullable();
            $table->string('categorie_socio_pro')->nullable();
            $table->string('permis')->nullable();
            $table->string('prime_nette')->nullable();
            $table->string('frais_courtier')->nullable();
            $table->string('accessoires')->nullable();
            $table->string('cfga')->nullable();
            $table->string('taxes_totales')->nullable();
            $table->string('primes_ttc')->nullable();
            $table->string('commission_courtier')->nullable();
            $table->string('gestion')->nullable();
            $table->string('commission_apporteur')->nullable();
            $table->string('type_garantie')->nullable();
            $table->string('zone')->nullable();
            $table->boolean('sync')->default(false);

            $table->foreignId('id_contrat');

            $table->foreign('id_contrat')
                ->references('id_contrat')
                ->on('contrats')
                ->onDelete('cascade');

          

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
        Schema::dropIfExists('automobiles');
    }
}
