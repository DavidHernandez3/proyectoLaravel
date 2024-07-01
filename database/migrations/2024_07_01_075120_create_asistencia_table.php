<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->time('hora_entrada');
            $table->integer('estudiante_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->foreign('estudiante_id')->references('id')->on('estudiante');
            $table->foreign('grupo_id')->references('id')->on('grupo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencia');
    }
};
