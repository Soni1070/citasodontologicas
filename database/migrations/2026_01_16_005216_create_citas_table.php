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
    Schema::create('citas', function (Blueprint $table) {
    $table->id();
    $table->dateTime('fecha_inicio');
    $table->dateTime('fecha_fin');

    $table->foreignId('paciente_id')->constrained()->cascadeOnDelete();
    $table->foreignId('dentista_id')->constrained()->cascadeOnDelete();
    $table->foreignId('consultorio_id')->constrained()->cascadeOnDelete();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
