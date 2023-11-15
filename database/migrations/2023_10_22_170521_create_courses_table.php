<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Added user_id column
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
        $table->string('name');
        $table->string('code');
        $table->unsignedInteger('credit_hours')->nullable();
        $table->json('lecturers')->nullable(); // Changed to JSON type
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
