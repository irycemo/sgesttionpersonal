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
        Schema::create('incapacidads', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->string('documento')->nullable();
            $table->string('tipo');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->foreignId('persona_id')->constrained();
            $table->text('observaciones')->nullable();
            $table->foreignId('creado_por')->nullable()->constrained()->references('id')->on('users');
            $table->foreignId('actualizado_por')->nullable()->constrained()->references('id')->on('users');
            $table->timestamps();

            $table->unique('folio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incapacidads');
    }
};
