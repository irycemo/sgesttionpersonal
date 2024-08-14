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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('numero_empleado')->unique();
            $table->string('foto')->nullable();
            $table->string('status')->default('activo');
            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->unsignedBigInteger('codigo_barras')->nullable()->unique();
            $table->string('localidad');
            $table->string('area');
            $table->string('tipo');
            $table->string('rfc')->unique();
            $table->string('curp')->unique();
            $table->string('telefono')->unique();
            $table->text('domicilio');
            $table->string('email')->nullable()->unique();
            $table->date('fecha_ingreso');
            $table->text('observaciones')->nullable();
            $table->foreignId('horario_id')->constrained();
            $table->foreignId('creado_por')->nullable()->constrained()->references('id')->on('users');
            $table->foreignId('actualizado_por')->nullable()->constrained()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
