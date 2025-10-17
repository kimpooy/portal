<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educational_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');

            $table->string('level')->nullable(); // e.g. High School, College, Master’s
            $table->string('school_name')->nullable();
            $table->string('degree_course')->nullable();
            $table->string('year_graduated', 4)->nullable();
            $table->string('honors_received')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educational_backgrounds');
    }
};
