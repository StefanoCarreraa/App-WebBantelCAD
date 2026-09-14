<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade'); // Región asociada
            $table->foreignId('center_id')->nullable()->constrained('centers')->onDelete('set null'); // Centro relacionado opcional
            $table->string('title'); // Título de la noticia
            $table->string('slug')->unique(); // Slug para URL amigable
            $table->text('summary')->nullable(); // Resumen breve
            $table->longText('content'); // Contenido completo
            $table->string('main_image')->nullable(); // Imagen principal
            $table->dateTime('published_at')->nullable(); // Fecha de publicación
            $table->enum('status', ['DRAFT', 'PUBLISHED', 'ARCHIVED'])->default('DRAFT'); // Estado de publicación
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};