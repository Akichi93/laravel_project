<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileAvenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_avenants', function (Blueprint $table) {
            $table->bigIncrements('id_fileavenant');

            $table->foreignId('id_avenant');

            $table->string('nom_file');
            $table->string('titre')->nullable();

            $table->foreign('id_avenant')
                ->references('id_avenant')
                ->on('avenants')
                ->onDelete('cascade');
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
        Schema::dropIfExists('file_avenants');
    }
}
