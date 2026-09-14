<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('digital_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade'); // Región asociada
            $table->string('title'); // Título del recurso
            $table->string('category'); // Guías, Tutoriales, Documentos
            $table->string('file_path')->nullable(); // Ruta del archivo descargable
            $table->string('external_url')->nullable(); // URL externa opcional
            $table->unsignedInteger('download_count')->default(0); // Conteo de descargas
            $table->timestamps();
        });

        Schema::create('external_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade'); // Región asociada
            $table->enum('category', ['STATE', 'PRONATEL', 'REGIONAL_GOV', 'UNIVERSITIES', 'MEDIA', 'OTHER']); // Categoría del enlace
            $table->string('title'); // Nombre del enlace
            $table->string('url'); // URL destino
            $table->string('logo_path')->nullable(); // Ruta del logo
            $table->boolean('is_active')->default(true); // Estado activo/inactivo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('external_links');
        Schema::dropIfExists('digital_resources');
    }
};