<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToContrats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contrats', function (Blueprint $table) {
            $table->integer('solde')->after('commission_apporteur')->comment('0 = encours, 1 = terminer')->default('0');
            $table->integer('reverse')->after('solde')->comment('0 = encours, 1 = terminer')->default('0');

            $table->foreignId('id_entreprise')->after('reverse')->nullable();
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
        Schema::table('contrats', function (Blueprint $table) {
            //
        });
    }
}
