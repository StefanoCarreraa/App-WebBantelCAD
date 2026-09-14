<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade');
            $table->string('code')->unique(); // p. ej., PA-0016-CA, HC-0003-CB, PA-0047-AU
            $table->enum('type', ['CAD_A', 'CAD_B', 'CAU']);
            $table->string('name');
            $table->string('province');
            $table->string('district');
            $table->string('locality');
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('schedule')->nullable();
            $table->text('services')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('image_path')->nullable();
            $table->enum('status', ['OPERATIVE', 'MAINTENANCE', 'INACTIVE'])->default('OPERATIVE');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('centers');
    }
};