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
    Schema::create('historias_clinicas', function (Blueprint $table) {
        $table->id();

        $table->foreignId('paciente_id')
              ->constrained('pacientes')
              ->onDelete('cascade');

        $table->text('antecedentes_medicos')->nullable();
        $table->text('enfermedades_sistemicas')->nullable();
        $table->text('medicamentos_actuales')->nullable();
        $table->text('antecedentes_odontologicos')->nullable();
        $table->text('observaciones_generales')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historia_clinicas');
    }
};
