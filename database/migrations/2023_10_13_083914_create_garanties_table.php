<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garanties', function (Blueprint $table) {
            $table->bigIncrements('id_garantie');
            $table->uuid('uuidGarantie');
            $table->uuid('uuidAutomobile');
            $table->unsignedBigInteger('id_automobile');
            $table->foreign('id_automobile')
                ->references('id_automobile')
                ->on('automobiles')
                ->onDelete('cascade');
            $table->string('nom_garantie');
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
        Schema::dropIfExists('garanties');
    }
}
