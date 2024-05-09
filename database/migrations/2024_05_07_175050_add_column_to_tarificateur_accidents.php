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
        Schema::table('tarificateur_accidents', function (Blueprint $table) {
                $table->string('sync')->default(false)->after('tauxIPT');
                $table->foreignId('id_entreprise')->after('sync');
                $table->foreignId('user_id')->after('id_entreprise');

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
        Schema::table('tarificateur_accidents', function (Blueprint $table) {
            //
        });
    }
};
