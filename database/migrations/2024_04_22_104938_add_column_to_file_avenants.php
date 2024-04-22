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
        Schema::table('file_avenants', function (Blueprint $table) {
            $table->uuid('uuidAvenant')->after('id_avenant');
            $table->foreignId('id_entreprise')->after('sync')->nullable();

            $table->foreign('id_entreprise')
                ->references('id_entreprise')
                ->on('entreprises')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_avenants', function (Blueprint $table) {
            //
        });
    }
};
