<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'name' => 'Computer Science and Engineering',
                'code' => 'CSE',
                'description' => 'Study of computing, programming, and software systems',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electrical and Electronic Engineering',
                'code' => 'EEE',
                'description' => 'Study of electrical systems and electronics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Civil Engineering',
                'code' => 'CE',
                'description' => 'Design and construction of infrastructure',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mechanical Engineering',
                'code' => 'ME',
                'description' => 'Study of machines and mechanical systems',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business Administration',
                'code' => 'BBA',
                'description' => 'Study of business, management, and administration',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Information and Communication Technology',
                'code' => 'ICT',
                'description' => 'Focus on information systems and communication technologies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

