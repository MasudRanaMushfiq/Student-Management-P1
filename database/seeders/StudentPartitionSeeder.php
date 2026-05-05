<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Student;


class StudentPartitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   // Seeder Commadn: php artisan db:seed --class=StudentPartitionSeeder
        $year = 17;
        $table = 'student' . $year;

        if (!Schema::hasTable($table)) {
            DB::statement("CREATE TABLE {$table} LIKE students");
        }

        $batchSize = 100; // IMPORTANT (not 1000)

        for ($i = 0; $i < 1000; $i += $batchSize) {

            $data = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $data[] = Student::factory()->make()->toArray();
            }

            DB::table($table)->insert($data);
        }

        $this->command->info("Seeded: {$table}");
    }
}
