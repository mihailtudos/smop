<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //posts table schema
        Schema::create('posts', function (Blueprint $table) {
            //creates and unique, auto incrementing field used as primary key
            $table->bigIncrements('id');
            //creates a foreign key used to establish the relation between
            //a record from posts table ( a post) and the a record form users table (the user ot the author)
            $table->unsignedBigInteger('user_id');
            //creates a field of type short-text to save post's title
            $table->string('title');
            //creates a field of type long-text to save post's description
            $table->text('description');
            //creates a field of type long-text to save post's body or content
            $table->text('body');
            //creates a field of type short-text to save post's the address to the post's image
            $table->string('image');
            //creates automatically two fields (created_at and updated_at) to track posts events
            $table->timestamps();

            //establishes the relation between the foreign key (user_id) with the users table,
            //on user's deletion the posts will be also removed
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
        Schema::dropIfExists('posts');
    }
}
