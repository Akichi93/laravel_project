<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('branche_prospects', function (Blueprint $table) {
            $table->uuid('uuidProspectBranche')->after('id_prosbranche');
            $table->foreignId('id_entreprise')->after('description')->nullable();
            $table->unsignedBigInteger('user_id')->after('id_entreprise')->nullable();

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
     */
    public function down(): void
    {
        Schema::table('branche_prospects', function (Blueprint $table) {
            //
        });
    }
};
