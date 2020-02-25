<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisorStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supervisor_id')->unsigned();
            $table->unsignedBigInteger('student_id')->unsigned();
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('users');
            $table->foreign('student_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisor_student');
    }
}
