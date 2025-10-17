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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();

            // 🔗 Link to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Personal Info
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('address');
            $table->string('phone_number')->unique(); // Unique phone number for applicants
            $table->string('highest_education'); // Highest education level
            $table->string('email')->unique(); // Optional email for applicants
            $table->string('civil_status'); // e.g., Single, Married,
            $table->date('birth_date');
            $table->string('Religion');
            $table->string('gender');

            // Eligibility
            $table->string('eligibility')->nullable(); // e.g., Civil Service Eligibility
            $table->decimal('eligibility_rating')->nullable(); // Rating for the eligibility
            $table->date('eligibility_date')->nullable(); // Date of eligibility exam
            $table->string('license_number')->nullable(); // Place of eligibility exam

            //  Work Experience
            $table->date('Inclusive_date_start')->nullable(); // Start date of work experience
            $table->date('Inclusive_date_end')->nullable(); // End date of work experience  
            $table->string('company_name')->nullable();
            $table->string('Position_title')->nullable();
            $table->string('status_of_appointment')->nullable(); 
            $table->string('monthly_salary')->nullable();  
            $table->string('government_service')->nullable(); // e.g., Yes, No

            // LDI
            $table->string('title_of_training')->nullable();
            $table->string('training_date_start')->nullable();
            $table->string('training_date_end')->nullable();  
            $table->string('number_of_hours')->nullable();
            $table->string('conducted_by')->nullable();

            //  Files
            $table->string('pds'); // Personal Data Sheet
            $table->string('tor')->nullable(); //Transcript of Records
            $table->string('diploma')->nullable();
            $table->string('eligibility_certificate')->nullable(); // Certificate of eligibility
            $table->string('certificate_of_trainings')->nullable(); // Certificate of training
            $table->string('IPCR')->nullable(); 


            // References
            $table->string('reference_name');
            $table->string('reference_address');
            $table->string('reference_phone');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
