<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('invigilator_id')->nullable();
            $table->string('number_of_lec')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('invigilator_id')->references('id')->on('lecturers');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
