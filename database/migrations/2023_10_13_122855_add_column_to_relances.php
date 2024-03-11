<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToRelances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relances', function (Blueprint $table) {
            $table->time('heure_relance')->after('date_relance')->nullable();
            $table->time('objet')->after('heure_relance')->nullable();
            $table->time('type')->after('objet')->nullable();

            $table->foreignId('id_entreprise')->after('type')->nullable();
            $table->unsignedBigInteger('user_id')->after('id_entreprise');

            $table->foreign('id_entreprise')
                ->references('id_entreprise')
                ->on('entreprises')
                ->onDelete('cascade');

           
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('relances', function (Blueprint $table) {
            //
        });
    }
}
