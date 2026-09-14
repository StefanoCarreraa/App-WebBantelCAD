<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CenterSeeder extends Seeder
{
    public function run(): void
    {
        $pascoId = DB::table('regions')->where('slug', 'pasco')->value('id');
        $huanucoId = DB::table('regions')->where('slug', 'huanuco')->value('id');

        // Matriz Huánuco (6 CAD A, 53 CAD B, 7 CAU = 66 total)
        $huanucoCenters = [
            ['code' => 'HC-0003-CA', 'type' => 'CAD_A', 'name' => 'CAD Colpas', 'province' => 'AMBO', 'district' => 'COLPAS', 'locality' => 'COLPAS', 'lat' => -10.268369, 'lng' => -76.415427],
            ['code' => 'HC-0005-CA', 'type' => 'CAD_A', 'name' => 'CAD San Francisco', 'province' => 'AMBO', 'district' => 'SAN FRANCISCO', 'locality' => 'MOSCA', 'lat' => -10.343168, 'lng' => -76.291743],
            ['code' => 'HC-0010-CA', 'type' => 'CAD_A', 'name' => 'CAD Marías', 'province' => 'DOS DE MAYO', 'district' => 'MARIAS', 'locality' => 'MARIAS', 'lat' => -9.607222, 'lng' => -76.705581],
            ['code' => 'HC-0012-CA', 'type' => 'CAD_A', 'name' => 'CAD Quivilla', 'province' => 'DOS DE MAYO', 'district' => 'QUIVILLA', 'locality' => 'QUIVILLA', 'lat' => -9.599518, 'lng' => -76.726362],
            ['code' => 'HC-0017-CA', 'type' => 'CAD_A', 'name' => 'CAD Canchabamba', 'province' => 'HUACAYBAMBA', 'district' => 'CANCHABAMBA', 'locality' => 'CANCHABAMBA', 'lat' => -8.884457, 'lng' => -77.123395],
            ['code' => 'HC-0018-CA', 'type' => 'CAD_A', 'name' => 'CAD Cochabamba', 'province' => 'HUACAYBAMBA', 'district' => 'COCHABAMBA', 'locality' => 'COCHABAMBA', 'lat' => -9.094731, 'lng' => -76.836652],
            ['code' => 'HC-0012-AU', 'type' => 'CAU', 'name' => 'CAU Quivilla', 'province' => 'DOS DE MAYO', 'district' => 'QUIVILLA', 'locality' => 'QUIVILLA', 'lat' => -9.599518, 'lng' => -76.726362],
            ['code' => 'HC-0018-AU', 'type' => 'CAU', 'name' => 'CAU Cochabamba', 'province' => 'HUACAYBAMBA', 'district' => 'COCHABAMBA', 'locality' => 'COCHABAMBA', 'lat' => -9.094731, 'lng' => -76.836652],
            ['code' => 'HC-0026-AU', 'type' => 'CAU', 'name' => 'CAU Miraflores', 'province' => 'HUAMALIES', 'district' => 'MIRAFLORES', 'locality' => 'MIRAFLORES', 'lat' => -9.493940, 'lng' => -76.818894],
            ['code' => 'HC-0048-AU', 'type' => 'CAU', 'name' => 'CAU Yarumayo', 'province' => 'HUANUCO', 'district' => 'YARUMAYO', 'locality' => 'YARUMAYO', 'lat' => -10.004217, 'lng' => -76.468397],
            ['code' => 'HC-0059-AU', 'type' => 'CAU', 'name' => 'CAU Naranjillo', 'province' => 'LEONCIO PRADO', 'district' => 'LUYANDO', 'locality' => 'NARANJILLO', 'lat' => -9.250797, 'lng' => -75.995646],
            ['code' => 'HC-0069-AU', 'type' => 'CAU', 'name' => 'CAU Molino', 'province' => 'PACHITEA', 'district' => 'MOLINO', 'locality' => 'MOLINO', 'lat' => -9.909973, 'lng' => -76.017569],
            ['code' => 'HC-0075-AU', 'type' => 'CAU', 'name' => 'CAU Puerto Sungaro', 'province' => 'PUERTO INCA', 'district' => 'PUERTO INCA', 'locality' => 'PUERTO SUNGARO', 'lat' => -9.373908, 'lng' => -75.036002],
        ];

        // Matriz Pasco (3 CAD A, 37 CAD B, 3 CAU = 43 total)
        $pascoCenters = [
            ['code' => 'PA-0016-CA', 'type' => 'CAD_A', 'name' => 'CAD Santa Ana de Tusi', 'province' => 'DANIEL ALCIDES CARRION', 'district' => 'SANTA ANA DE TUSI', 'locality' => 'SANTA ANA DE TUSI', 'lat' => -10.471900, 'lng' => -76.353200],
            ['code' => 'PA-0072-CA', 'type' => 'CAD_A', 'name' => 'CAD Constitución', 'province' => 'OXAPAMPA', 'district' => 'CONSTITUCION', 'locality' => 'CONSTITUCION', 'lat' => -9.864069, 'lng' => -75.018633],
            ['code' => 'PA-0202-CA', 'type' => 'CAD_A', 'name' => 'CAD Huayllay', 'province' => 'PASCO', 'district' => 'HUAYLLAY', 'locality' => 'HUAYLLAY', 'lat' => -11.003200, 'lng' => -76.365320],
            ['code' => 'PA-0047-AU', 'type' => 'CAU', 'name' => 'CAU Chinche', 'province' => 'DANIEL ALCIDES CARRION', 'district' => 'YANAHUANCA', 'locality' => 'CHINCHE', 'lat' => -10.510960, 'lng' => -76.585230],
            ['code' => 'PA-0108-AU', 'type' => 'CAU', 'name' => 'CAU Miraflores N2', 'province' => 'OXAPAMPA', 'district' => 'OXAPAMPA', 'locality' => 'MIRAFLORES NUMERO 2', 'lat' => -10.596000, 'lng' => -75.385000],
            ['code' => 'PA-0285-AU', 'type' => 'CAU', 'name' => 'CAU Colquijirca', 'province' => 'PASCO', 'district' => 'TINYAHUARCO', 'locality' => 'COLQUIJIRCA', 'lat' => -10.753173, 'lng' => -76.264223],
        ];

        $this->insertMatrix($huanucoCenters, $huanucoId, 'HC', 53);
        $this->insertMatrix($pascoCenters, $pascoId, 'PA', 37);
    }

    private function insertMatrix(array $data, int $regionId, string $prefix, int $cadBCount): void
    {
        foreach ($data as $c) {
            DB::table('centers')->updateOrInsert(['code' => $c['code']], [
                'region_id' => $regionId,
                'type' => $c['type'],
                'name' => $c['name'],
                'province' => $c['province'],
                'district' => $c['district'],
                'locality' => $c['locality'],
                'latitude' => $c['lat'],
                'longitude' => $c['lng'],
                'status' => 'OPERATIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= $cadBCount; $i++) {
            $code = sprintf('%s-%04d-CB', $prefix, $i + 100);
            DB::table('centers')->updateOrInsert(['code' => $code], [
                'region_id' => $regionId,
                'type' => 'CAD_B',
                'name' => "CAD Localidad $i",
                'province' => 'PROVINCIA',
                'district' => 'DISTRITO',
                'locality' => "LOCALIDAD $i",
                'latitude' => -10.0,
                'longitude' => -76.0,
                'status' => 'OPERATIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
