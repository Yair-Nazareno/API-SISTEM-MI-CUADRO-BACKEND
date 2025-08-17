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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
           // Quién pagó
            $table->decimal('monto', 8, 2); // Monto del pago
            $table->string('comprobante')->nullable(); // Foto del comprobante (URL)
            $table->text('descripcion')->nullable(); // Detalles adicionales
            $table->enum('estado', ['pendiente', 'verificado', 'rechazado'])->default('pendiente'); // Validación del admin
            $table->date('fecha_pago'); // Cuándo se realizó el pago
            $table->foreignId('participant_id')->constrained('participants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
