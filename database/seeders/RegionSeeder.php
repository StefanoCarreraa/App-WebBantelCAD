<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('regions')->updateOrInsert(
            ['slug' => 'pasco'],
            [
                'name' => 'Pasco',
                'total_cad_a' => 3,
                'total_cad_b' => 37,
                'total_cau' => 3,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('regions')->updateOrInsert(
            ['slug' => 'huanuco'],
            [
                'name' => 'Huánuco',
                'total_cad_a' => 6,
                'total_cad_b' => 53,
                'total_cau' => 7,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}