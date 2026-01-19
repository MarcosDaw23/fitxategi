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
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('check_in'); // Hora de entrada
            $table->dateTime('check_out')->nullable(); // Hora de salida
            $table->integer('total_minutes')->nullable(); // Total de minutos
            $table->date('date'); // Fecha del registro
            $table->enum('status', ['completed', 'active', 'incomplete'])->default('active'); 
            $table->text('notes')->nullable(); // Notas o incidencias
            $table->string('location')->nullable(); // Ubicación opcional
            $table->timestamps();
            
            $table->index(['user_id', 'date']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
