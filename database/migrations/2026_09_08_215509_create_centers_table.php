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
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade'); // Relación con la región
            $table->string('code')->unique(); // Ejemplo: PA-0016-CA, HC-0003-CB, PA-0047-AU
            $table->enum('type', ['CAD_A', 'CAD_B', 'CAU']); // Tipo de centro
            $table->string('name'); // Nombre del centro
            $table->string('province'); // Provincia
            $table->string('district'); // Distrito
            $table->string('locality'); // Localidad o centro poblado
            $table->text('address')->nullable(); // Dirección exacta
            $table->decimal('latitude', 10, 8)->nullable(); // Latitud geográfica
            $table->decimal('longitude', 11, 8)->nullable(); // Longitud geográfica
            $table->text('schedule')->nullable(); // Horario de atención
            $table->text('services')->nullable(); // Servicios ofrecidos
            $table->string('phone')->nullable(); // Teléfono de contacto
            $table->string('email')->nullable(); // Correo institucional
            $table->string('facebook_url')->nullable(); // Enlace de Facebook
            $table->string('image_path')->nullable(); // Ruta de la imagen del centro
            $table->enum('status', ['OPERATIVE', 'MAINTENANCE', 'INACTIVE'])->default('OPERATIVE'); // Estado operativo del centro
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('centers');
    }
};