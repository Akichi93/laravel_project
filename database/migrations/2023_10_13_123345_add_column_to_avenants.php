<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAvenants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('avenants', function (Blueprint $table) {
            $table->foreignId('id_entreprise')->after('taxes_totales')->nullable();
            $table->unsignedBigInteger('user_id')->after('id_entreprise');
            $table->string('payer_courtier')->after('id_entreprise')->default(0);
            $table->string('payer_apporteur')->after('payer_courtier')->default(0);

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
        Schema::table('avenants', function (Blueprint $table) {
            //
        });
    }
}
