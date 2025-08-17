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
        Schema::create('cuadros', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del cuadro (ej. "Mi cuadro 1")
            $table->decimal('monto_individual', 8, 2); // Cuánto aporta cada persona
            $table->integer('total_participantes'); // Total planificado (ej. 10, 15, 20)
            $table->enum('frecuencia_pago', ['semanal', 'quincenal', 'mensual']);
            $table->integer('duracion')->comment('En semanas, quincenas o meses según frecuencia');
            $table->integer('duracion_dias')->default(0);
            $table->decimal('fondo_respaldo', 8, 2)->default(0); // $100 inicial por defecto

            // Referencia al organizador (usuario creador del cuadro)
            $table->foreignId('organizador_id')->constrained('users')->onDelete('cascade');

            $table->boolean('activo')->default(true); // Estado del cuadro (cancelado o en curso)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuadros');
    }
};
