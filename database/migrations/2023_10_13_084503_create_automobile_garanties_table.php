<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomobileGarantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automobile_garanties', function (Blueprint $table) {
            $table->unsignedBigInteger('id_automobile');
            $table->foreign('id_automobile')
                ->references('id_automobile')
                ->on('automobiles')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_garantie');
            $table->foreign('id_garantie')
                ->references('id_garantie')
                ->on('garanties')
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
        Schema::dropIfExists('automobile_garanties');
    }
}
