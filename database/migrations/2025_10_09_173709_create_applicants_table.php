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
            $table->string('address')->nullable();
            $table->string('phone_number')->unique(); // Unique phone number for applicants
            $table->string('highest_education'); // Highest education level
            $table->string('email')->unique(); // Optional email for applicants
            $table->string('civil_status'); // e.g., Single, Married,
            $table->date('birth_date')->default('1900-01-01');
            $table->string('religion');
            $table->string('gender');

            //  Files
            $table->string('pds'); // Personal Data Sheet
            $table->string('tor')->nullable(); //Transcript of Records
            $table->string('diploma')->nullable();
            $table->string('eligibility_certificate')->nullable(); // Certificate of eligibility
            $table->string('certificate_of_trainings')->nullable(); // Certificate of training
            $table->string('IPCR')->nullable(); 


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
