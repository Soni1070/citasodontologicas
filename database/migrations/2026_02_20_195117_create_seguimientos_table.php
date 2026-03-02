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
    Schema::create('seguimientos', function (Blueprint $table) {
        $table->id();

        $table->foreignId('historia_clinica_id')
              ->constrained('historias_clinicas')
              ->onDelete('cascade');

        $table->foreignId('cita_id')
              ->constrained('citas')
              ->onDelete('cascade');

        $table->text('diagnostico');
        $table->text('tratamiento');
        $table->text('observaciones')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};
