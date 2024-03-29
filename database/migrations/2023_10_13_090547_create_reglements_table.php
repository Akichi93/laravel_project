<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reglements', function (Blueprint $table) {
            $table->bigIncrements('id_reglement');
            $table->uuid('uuidReglement');

            $table->unsignedBigInteger('id_sinistre');
            $table->foreign('id_sinistre')
                ->references('id_sinistre')
                ->on('sinistres')
                ->onDelete('cascade');

            $table->string('type_reglement');
            $table->string('nom');
            $table->string('mode');
            $table->integer('montant');
            $table->date('date_reglement');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->boolean('sync')->default(false);

            $table->string('supprimer_reglement')->comment('0 = encours, 1 = supprimé')->default(0);
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
        Schema::dropIfExists('reglements');
    }
}
