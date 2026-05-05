<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Basic Identity
            $table->string('exam_roll', 15);
            $table->string('applicant_id', 20);
            $table->string('student_id', 20);
            $table->string('fullname', 150);
            $table->string('fname', 70);
            $table->string('mname', 70);
            $table->string('gender', 15);
            $table->string('date_of_birth', 15);
            $table->string('place_of_birth', 60);
            $table->string('nationality', 40);
            $table->string('religion', 20);
            $table->string('blood_group', 15);
            $table->string('height', 15);
            $table->string('mobile_no', 20);
            $table->string('em_address', 70);
            $table->string('guardian_name', 150);

            // SSC Information
            $table->string('ssc_board', 40);
            $table->string('ssc_roll', 20);
            $table->string('ssc_regno', 20);
            $table->string('ssc_year', 15);
            $table->string('ssc_group', 30);
            $table->string('ssc_gpa', 15);
            $table->string('ssc_ltrgrd', 200);
            $table->string('ssc_institute', 300);

            // HSC Information
            $table->string('hsc_board', 40);
            $table->string('hsc_roll', 20);
            $table->string('hsc_regno', 20);
            $table->string('hsc_year', 15);
            $table->string('hsc_group', 40);
            $table->string('hsc_gpa', 15);
            $table->string('hsc_ltrgrd', 200);
            $table->string('hsc_institute', 300);

            // Admission Information
            $table->string('unit', 6);
            $table->string('faculty', 80);
            $table->string('department', 70);
            $table->string('hall', 90);
            $table->string('hall_code', 20);
            $table->string('department_code', 20);
            $table->string('class_roll', 20);
            $table->string('quota', 30);
            $table->string('category', 50);
            $table->string('category_code', 10);
            $table->string('exam_score', 20);
            $table->string('merit_position', 20);

            // Status Fields
            $table->string('admission_status', 20);
            $table->string('student_status', 70);
            $table->string('migration_status', 70);
            $table->string('verifier', 40);

            // Payment Information
            $table->string('payment_trxid', 50);
            $table->string('payment_amount', 50);
            $table->string('payment_date', 50);
            $table->string('payment_sender', 50);

            // Documents
            $table->string('org_photo', 30);
            $table->string('photo', 30);

            // Address
            $table->string('present_addr', 300);
            $table->string('present_district', 30);
            $table->string('present_thana', 70);
            $table->string('present_post', 70);

            $table->string('permanent_addr', 300);
            $table->string('permanent_district', 40);
            $table->string('permanent_thana', 70);
            $table->string('permanent_post', 70);

            // Emergency Contact
            $table->string('emergency_contact', 300);
            $table->string('emergency_relation', 50);
            $table->string('emergency_phone', 20);

            // Identification
            $table->string('national_id', 50);
            $table->string('passport_no', 50);
            $table->string('birth_regno', 30);

            $table->timestamp('last_change')->useCurrent()->useCurrentOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
