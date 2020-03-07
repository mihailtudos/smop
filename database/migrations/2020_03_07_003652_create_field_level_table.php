<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_level', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('field_id');
            $table->timestamps();

            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_level');
    }
}
