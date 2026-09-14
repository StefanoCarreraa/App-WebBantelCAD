<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enlaces_externos', function (Blueprint $table) {
            $table->string('category')->change();
        });
    }

    public function down(): void
    {
        Schema::table('enlaces_externos', function (Blueprint $table) {
            $table->enum('category', [
                'STATE',
                'PRONATEL',
                'REGIONAL_GOV',
                'UNIVERSITIES',
                'MEDIA',
                'OTHER',
            ])->change();
        });
    }
};
