<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained('centers')->onDelete('cascade'); // Centro asociado
            $table->string('title'); // Título de la actividad
            $table->string('category')->default('General'); // Categoría general
            $table->string('activity_type')->nullable(); // Tipo de actividad
            $table->string('target_audience')->default('Población general'); // Público objetivo
            $table->text('description')->nullable(); // Descripción de la actividad
            $table->string('responsable_name')->nullable(); // Responsable de la actividad
            $table->unsignedInteger('attendees_count')->nullable()->default(0); // Número de asistentes
            $table->dateTime('start_datetime'); // Fecha y hora de inicio
            $table->dateTime('end_datetime')->nullable(); // Fecha y hora de fin
            $table->enum('status', ['SCHEDULED', 'RESCHEDULED', 'CANCELED', 'COMPLETED'])->default('SCHEDULED'); // Estado de la actividad
            $table->string('evidence_image')->nullable(); // Imagen de evidencia
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};