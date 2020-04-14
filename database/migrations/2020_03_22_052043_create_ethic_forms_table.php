<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEthicFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ethic_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->unique();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('student_id')->unique();
            $table->string('title');

            $table->boolean('needs_to_be_referred')->nullable()->default(null);
            $table->text('reason_to_be_referred')->nullable()->default(null);

            $table->boolean('project_will_contain')->nullable()->default(null);

            $table->boolean('approved')->nullable()->default(null);
            $table->text('reason_to_reject')->nullable()->default(null);

            $table->boolean('truthfulness')->nullable()->default(null);
            $table->boolean('supervisor_completed')->nullable()->default(null);
            $table->boolean('copy_of_instruments')->nullable()->default(null);
            $table->boolean('copy_of_proposal')->nullable()->default(null);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ethic_forms');
    }
}
