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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_consulta');
            $table->text('motivo_consulta');
            $table->text('sintomas');
            $table->text('diagnostico');
            $table->text('observaciones')->nullable();
            $table->string('presion_arterial')->nullable();
            $table->decimal('temperatura', 4, 2)->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->date('proxima_cita')->nullable();
            $table->string('estado')->default('activa');
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('medico_id')->constrained('medicos')->onDelete('cascade');
            $table->foreignId('establecimiento_id')->constrained('establecimientos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
