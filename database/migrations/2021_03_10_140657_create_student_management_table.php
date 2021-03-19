<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_management', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('surname');
            $table->string('other_name');  
            $table->string('semester');
            $table->string('program');
            $table->string('course_code');
            $table->string('course');
            $table->string('campus');
            $table->string('email');
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
        Schema::dropIfExists('student_management');
    }
}
