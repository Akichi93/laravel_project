<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileSinistresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_sinistres', function (Blueprint $table) {
            $table->bigIncrements('id_fichier');
            $table->string('nom_fichier');

            $table->unsignedBigInteger('id_sinistre');
            $table->foreign('id_sinistre')
                ->references('id_sinistre')
                ->on('sinistres')
                ->onDelete('cascade');
                
            $table->string('titre');
            $table->boolean('sync')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('file_sinistres');
    }
}
