<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->bigIncrements('id_depense');
            $table->foreignId('id_catdep');

            $table->foreign('id_catdep')
                ->references('id_catdep')
                ->on('categorie_depenses')
                ->onDelete('cascade');

            $table->foreignId('id_typedep');

            $table->foreign('id_typedep')
                ->references('id_typedep')
                ->on('type_depenses')
                ->onDelete('cascade');

            $table->date('date_operation');
            $table->string('montant');
            $table->string('info_depense');
            $table->integer('etat')->default(0);
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
        Schema::dropIfExists('depenses');
    }
}
