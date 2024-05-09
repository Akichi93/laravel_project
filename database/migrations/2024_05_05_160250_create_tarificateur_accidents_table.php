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
        Schema::create('tarificateur_accidents', function (Blueprint $table) {
            $table->bigIncrements('id_tarificateuria');
            $table->uuid('uuidTarificateurAccident');
            $table->integer('classe');
            $table->string('activite');         
            $table->decimal('tauxDeces', 4, 1);
            $table->decimal('tauxIPT', 4, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarificateur_accidents');
    }
};
