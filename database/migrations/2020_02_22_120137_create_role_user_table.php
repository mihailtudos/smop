<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            //creates the primary key of the table and sets it to auto increment itself
            $table->bigIncrements('id');
            //creates the secondary key that would hold user's role id
            $table->unsignedBigInteger('role_id');
            //creates the secondary key that would hold role's user id
            $table->unsignedBigInteger('user_id');
            //creates two fields "created_at" and "updated_at" to track when the role was created and when was updated
            $table->timestamps();

            //establishes a relationship link between role_id in the table and the roles table
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            //establishes a relationship link between user_id in the table and the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
