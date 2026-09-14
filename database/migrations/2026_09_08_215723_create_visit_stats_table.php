<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade'); // Región visitada
            $table->string('page_type'); // Ejemplo: HOME, CAD_DETAIL, AGENDA, NEWS
            $table->foreignId('center_id')->nullable()->constrained('centers')->onDelete('cascade'); // Centro relacionado opcional
            $table->date('visit_date'); // Fecha de la visita
            $table->unsignedInteger('views_count')->default(1); // Número de visualizaciones
            $table->unsignedInteger('unique_visitors')->default(1); // Visitantes únicos estimados
            $table->timestamps();

            $table->unique(['region_id', 'page_type', 'center_id', 'visit_date'], 'unique_stat_daily');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_stats');
    }
};