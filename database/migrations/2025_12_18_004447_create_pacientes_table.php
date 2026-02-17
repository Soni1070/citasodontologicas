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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('documento', 100)->unique();
            $table->string('numero_seguro', 100)->unique();
            $table->string('fecha_nacimiento', 15);
            $table->string('genero', 15);
            $table->string('telefono', 15);
            $table->string('correo', 200)->unique();
            $table->string('direccion', 200);
            $table->string('grupo_sanguineo', 100);
            $table->string('alergias', 300);
            $table->string('contacto_emergencia', 300);
            $table->string('observaciones', 300);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
