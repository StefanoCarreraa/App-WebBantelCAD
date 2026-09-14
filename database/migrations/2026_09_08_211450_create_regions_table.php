<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ejemplo: Pasco, Huánuco
            $table->string('slug')->unique(); // Ejemplo: pasco, huanuco
            $table->integer('total_cad_a')->default(0); // Total de CAD tipo A
            $table->integer('total_cad_b')->default(0); // Total de CAD tipo B
            $table->integer('total_cau')->default(0); // Total de CAU
            $table->boolean('status')->default(true); // Estado activo/inactivo de la región
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};