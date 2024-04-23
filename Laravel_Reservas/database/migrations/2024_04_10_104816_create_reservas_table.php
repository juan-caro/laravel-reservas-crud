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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tipo_id');
            $table->foreignId('sala_zoom_id')->constrained('salas_zoom')->cascadeOnDelete();
            $table->datetime('fecha');
            $table->timestamps();
            $table->string('titulo');
            $table->text('descripcion');
            $table->char('codigo_sipro', 10);
            $table->enum('estado', ['pendiente', 'tramitada'])->default('pendiente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
