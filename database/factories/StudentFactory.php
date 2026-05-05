<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [

            // Basic Identity
            'exam_roll' => $this->faker->unique()->numerify('EXM#######'),
            'applicant_id' => $this->faker->unique()->numerify('APP#####'),
            'student_id' => $this->faker->unique()->numerify('STD######'),
            'fullname' => $this->faker->name(),
            'fname' => $this->faker->name('male'),
            'mname' => $this->faker->name('female'),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'date_of_birth' => $this->faker->date(),
            'place_of_birth' => $this->faker->city(),
            'nationality' => 'Bangladeshi',
            'religion' => $this->faker->randomElement(['Islam', 'Hindu', 'Christian']),
            'blood_group' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-']),
            'height' => $this->faker->randomElement(['5.4', '5.5', '5.6', '5.7', '5.8']),
            'mobile_no' => $this->faker->numerify('01#########'),
            'em_address' => $this->faker->email(),
            'guardian_name' => $this->faker->name(),

            // SSC
            'ssc_board' => 'Dhaka',
            'ssc_roll' => $this->faker->numerify('#######'),
            'ssc_regno' => $this->faker->numerify('#######'),
            'ssc_year' => '2020',
            'ssc_group' => 'Science',
            'ssc_gpa' => $this->faker->randomFloat(2, 3.5, 5.0),
            'ssc_ltrgrd' => 'A+',
            'ssc_institute' => $this->faker->company(),

            // HSC
            'hsc_board' => 'Dhaka',
            'hsc_roll' => $this->faker->numerify('#######'),
            'hsc_regno' => $this->faker->numerify('#######'),
            'hsc_year' => '2022',
            'hsc_group' => 'Science',
            'hsc_gpa' => $this->faker->randomFloat(2, 3.5, 5.0),
            'hsc_ltrgrd' => 'A',
            'hsc_institute' => $this->faker->company(),

            // Admission - RANDOMIZED
            'unit' => $this->faker->randomElement(['A', 'B', 'C']),
            'faculty' => 'Engineering',

            'department' => $this->faker->randomElement([
                'CSE',
                'EEE',
                'BBA'
            ]),

            'hall' => $this->faker->randomElement([
                'Bijoy 24 Hall',
                'Motihar Hall',
                'Hobibur Hall'
            ]),

            'hall_code' => $this->faker->randomElement([
                'BI01',
                'MO02',
                'HO03'
            ]),

            'department_code' => function (array $attributes) {
                return $attributes['department'];
            },

            'class_roll' => $this->faker->numerify('####'),
            'quota' => 'General',
            'category' => 'Regular',
            'category_code' => 'REG',
            'exam_score' => $this->faker->numberBetween(40, 100),
            'merit_position' => $this->faker->numberBetween(1, 5000),

            // Status
            'admission_status' => 'Admitted',
            'student_status' => 'Active',
            'migration_status' => 'None',
            'verifier' => 'System',

            // Payment
            'payment_trxid' => $this->faker->uuid(),
            'payment_amount' => '5000',
            'payment_date' => now()->toDateString(),
            'payment_sender' => 'bKash',

            // Documents
            'org_photo' => 'org.jpg',
            'photo' => 'photo.jpg',

            // Address
            'present_addr' => $this->faker->address(),
            'present_district' => $this->faker->city(),
            'present_thana' => 'Sadar',
            'present_post' => '1000',

            'permanent_addr' => $this->faker->address(),
            'permanent_district' => $this->faker->city(),
            'permanent_thana' => 'Sadar',
            'permanent_post' => '1000',

            // Emergency
            'emergency_contact' => $this->faker->name(),
            'emergency_relation' => 'Father',
            'emergency_phone' => $this->faker->numerify('01#########'),

            // ID
            'national_id' => $this->faker->numerify('##########'),
            'passport_no' => strtoupper($this->faker->bothify('??#######')),
            'birth_regno' => $this->faker->numerify('############'),

            'last_change' => now(),
        ];
    }
}
