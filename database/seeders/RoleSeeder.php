<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'ict']);
        Role::create(['name' => 'dept']);
        Role::create(['name' => 'exam-controller']);
    }
}

