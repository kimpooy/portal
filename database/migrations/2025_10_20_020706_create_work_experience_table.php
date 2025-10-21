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
        Schema::create('work_experience', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('position_title')->nullable();
            $table->string('status_of_appointment')->nullable();
            $table->float('monthly_salary')->nullable();
            $table->date('inclusive_date_start')->nullable();
            $table->date('inclusive_date_end')->nullable();
            $table->boolean('government_service')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experience');
    }
};
