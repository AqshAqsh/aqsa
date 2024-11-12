<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalProfileFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Personal Information
            $table->string('full_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('contact_number')->nullable();
            
            // Address Details
            $table->string('permanent_address')->nullable();
            $table->string('current_address')->nullable();

            // Educational Details
            $table->string('college_roll_number')->nullable();
            $table->string('college_department')->nullable();
            $table->string('semester')->nullable();
            $table->string('program')->nullable();
            $table->year('enrollment_year')->nullable();

            // Hostel Information
            $table->unsignedBigInteger('room_number')->nullable();
            $table->string('hostel_block')->nullable();
            $table->string('bed_number')->nullable();

            // Guardian/Emergency Contact
            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact_number')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('relation_to_guardian')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'full_name', 'gender', 'date_of_birth', 'contact_number', 
                'permanent_address', 'current_address', 
                'college_roll_number', 'college_department', 'semester', 
                'program', 'enrollment_year', 'room_number', 'hostel_block', 
                'bed_number', 'guardian_name', 'guardian_contact_number', 
                'guardian_address', 'relation_to_guardian'
            ]);
        });
    }
}