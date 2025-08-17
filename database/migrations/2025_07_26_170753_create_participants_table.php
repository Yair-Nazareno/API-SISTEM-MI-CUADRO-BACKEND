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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario que participa
            $table->foreignId('cuadro_id')->constrained()->onDelete('cascade'); // Cuadro al que pertenece
            $table->integer('numero_turno'); // Posición en la ronda
            $table->enum('estado', ['activo', 'retirado', 'pagado'])->default('activo'); // Estado del participante
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
