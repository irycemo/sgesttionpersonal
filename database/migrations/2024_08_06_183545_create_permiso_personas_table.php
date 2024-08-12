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
        Schema::create('permiso_persona', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained();
            $table->foreignId('permisos_id')->constrained();
            $table->foreignId('creado_por')->nullable()->constrained()->references('id')->on('users');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_final')->nullable();
            $table->integer('tiempo_consumido')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permiso_persona');
    }
};
