<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrancheProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branche_prospects', function (Blueprint $table) {
            $table->bigIncrements('id_prosbranche');

            $table->foreignId('id_prospect');
            $table->foreign('id_prospect')
                ->references('id_prospect')
                ->on('prospects')
                ->onDelete('cascade');

            $table->foreignId('id_branche');
            $table->foreign('id_branche')
                ->references('id_branche')
                ->on('branches')
                ->onDelete('cascade');

            $table->uuid('uuidProspect');
            $table->uuid('uuidBranche');
            $table->longText('description');
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
        Schema::dropIfExists('branche_prospects');
    }
}
