<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomobileContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automobile_contrats', function (Blueprint $table) {
            $table->unsignedBigInteger('id_automobile');
            $table->foreign('id_automobile')
                ->references('id_automobile')
                ->on('automobiles')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_contrat');
            $table->foreign('id_contrat')
                ->references('id_contrat')
                ->on('contrats')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('automobile_contrats');
    }
}
