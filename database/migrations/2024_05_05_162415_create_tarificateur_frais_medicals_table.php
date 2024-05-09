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
        Schema::create('tarificateur_frais_medicals', function (Blueprint $table) {
            $table->id();
            // $table->uuid('uuidFraisMedical');
            $table->uuid('uuidTarificateurAccident');

            // $table->foreignId('id_fraismedical');
            // $table->foreign('id_fraismedical')
            //     ->references('id_fraismedical')
            //     ->on('frais_medicals')
            //     ->onDelete('cascade');

            $table->foreignId('id_tarificateuria');
            $table->foreign('id_tarificateuria')
                ->references('id_tarificateuria')
                ->on('tarificateur_accidents')
                ->onDelete('cascade');

            $table->integer('taux');
            $table->boolean('sync')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarificateur_frais_medicals');
    }
};
