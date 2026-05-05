<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            HallSeeder::class,
            StudentSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            AdminUserSeeder::class,
            StudentPartitionSeeder::class,
        ]);

        // Optional default user
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

