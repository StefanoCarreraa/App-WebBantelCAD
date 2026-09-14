<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $renames = [
            'regions' => 'regiones',
            'centers' => 'centros',
            'activities' => 'actividades',
            'news' => 'noticias',
            'activity_evidences' => 'evidencias_actividades',
            'digital_resources' => 'recursos_digitales',
            'external_links' => 'enlaces_externos',
            'visit_stats' => 'estadisticas_visitas',
        ];

        foreach ($renames as $source => $target) {
            if (Schema::hasTable($source) && !Schema::hasTable($target)) {
                Schema::rename($source, $target);
            }
        }
    }

    public function down(): void
    {
        $renames = [
            'regiones' => 'regions',
            'centros' => 'centers',
            'actividades' => 'activities',
            'noticias' => 'news',
            'evidencias_actividades' => 'activity_evidences',
            'recursos_digitales' => 'digital_resources',
            'enlaces_externos' => 'external_links',
            'estadisticas_visitas' => 'visit_stats',
        ];

        foreach ($renames as $source => $target) {
            if (Schema::hasTable($source) && !Schema::hasTable($target)) {
                Schema::rename($source, $target);
            }
        }
    }
};
