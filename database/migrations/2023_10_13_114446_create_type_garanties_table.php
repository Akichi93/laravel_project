<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeGarantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_garanties', function (Blueprint $table) {
            $table->bigIncrements('id_typegarantie');
            $table->unsignedBigInteger('id_garantie');
            $table->foreign('id_garantie')
                ->references('id_garantie')
                ->on('garanties')
                ->onDelete('cascade');
            // $table->unsignedBigInteger('id_contrat');
            // $table->foreign('id_contrat')
            //     ->references('id_contrat')
            //     ->on('contrats')
            //     ->onDelete('cascade');
            $table->string('type_garantie');
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
        Schema::dropIfExists('type_garanties');
    }
}
