<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HallSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('halls')->insert([
            [
                'name' => 'Sher-e-Bangla Hall',
                'hall_code' => 'SBH',
                'seats' => 500,
                'assigned' => 320,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bangabandhu Hall',
                'hall_code' => 'BBH',
                'seats' => 600,
                'assigned' => 450,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shaheed Zia Hall',
                'hall_code' => 'SZH',
                'seats' => 450,
                'assigned' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khan Jahan Ali Hall',
                'hall_code' => 'KJH',
                'seats' => 550,
                'assigned' => 400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bijoy Hall',
                'hall_code' => 'BJH',
                'seats' => 400,
                'assigned' => 250,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Central Hall',
                'hall_code' => 'CH',
                'seats' => 700,
                'assigned' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

