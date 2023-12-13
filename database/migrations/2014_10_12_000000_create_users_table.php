<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//return new class extends Migration
class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('department')->nullable();
            $table->string('faculty');
            $table->string('lecturer')->nullable();
            $table->string('courses')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('active');
            $table->rememberToken();
            $table->timestamps();

            $table->foreignId('current_team_id')->nullable();
            // $table->foreign('department')->references('id')->on('departments');
            // $table->foreign('faculty')->references('id')->on('faculties');
            // $table->foreign('courses')->references('id')->on('courses');
            // $table->foreign('lecturer')->references('id')->on('lecturers');
        });

    }  
        

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
