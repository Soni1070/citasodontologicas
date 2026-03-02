<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('dentistas', function (Blueprint $table) {

        if (Schema::hasColumn('dentistas', 'consultorio_id')) {
            $table->dropForeign(['consultorio_id']);
            $table->dropColumn('consultorio_id');
        }

        if (Schema::hasColumn('dentistas', 'dias_laborales')) {
            $table->dropColumn('dias_laborales');
        }
    });
}

public function down()
{
    Schema::table('dentistas', function (Blueprint $table) {

        $table->json('dias_laborales')->nullable();

        $table->unsignedBigInteger('consultorio_id')->nullable();

        $table->foreign('consultorio_id')
              ->references('id')
              ->on('consultorios')
              ->onDelete('set null');
    });
}
};
