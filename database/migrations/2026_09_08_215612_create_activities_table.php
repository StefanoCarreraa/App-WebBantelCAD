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
            $table->foreignId('center_id')->constrained('centers')->onDelete('cascade');
            $table->string('title');
            $table->string('category')->default('General');
            $table->string('activity_type')->nullable();
            $table->string('target_audience')->default('Población general');
            $table->text('description')->nullable();
            $table->string('responsable_name')->nullable();
            $table->unsignedInteger('attendees_count')->nullable()->default(0);
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime')->nullable();
            $table->enum('status', ['SCHEDULED', 'RESCHEDULED', 'CANCELED', 'COMPLETED'])->default('SCHEDULED');
            $table->string('evidence_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};