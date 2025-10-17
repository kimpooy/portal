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
    Schema::create('jobs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('employment_type'); // e.g. Permanent, Contract of Service, Job Order
        $table->string('location');
        $table->decimal('salary', 10, 2);
        $table->string('salary_grade');
        $table->string('qualifications');
        $table->date('application_deadline');
        $table->timestamps();
    });
}

};
