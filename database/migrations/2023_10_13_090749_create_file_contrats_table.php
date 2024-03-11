<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_contrats', function (Blueprint $table) {
            $table->bigIncrements('id_filecontrat');

            $table->foreignId('id_contrat');

            $table->string('nom_file');
            $table->string('titre')->nullable();

            $table->foreign('id_contrat')
                ->references('id_contrat')
                ->on('contrats')
                ->onDelete('cascade');

            $table->boolean('sync')->default(true);

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
        Schema::dropIfExists('file_contrats');
    }
}
