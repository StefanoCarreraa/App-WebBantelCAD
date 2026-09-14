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
            $table->string('name'); // Pasco, Huánuco
            $table->string('slug')->unique(); // pasco, huanuco
            $table->integer('total_cad_a')->default(0);
            $table->integer('total_cad_b')->default(0);
            $table->integer('total_cau')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};