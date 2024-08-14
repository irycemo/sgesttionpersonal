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
        Schema::table('horarios', function (Blueprint $table) {
            $table->renameColumn('tipo', 'nombre');
            $table->dropColumn('entrada_mixta');
            $table->dropColumn('salida_mixta');
            $table->dropColumn('entrada');
            $table->dropColumn('salida');
            $table->time('lunes_entrada');
            $table->time('lunes_salida');
            $table->time('martes_entrada');
            $table->time('martes_salida');
            $table->time('miercoles_entrada');
            $table->time('miercoles_salida');
            $table->time('jueves_entrada');
            $table->time('jueves_salida');
            $table->time('viernes_entrada');
            $table->time('viernes_salida');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
