<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_user', function (Blueprint $table) {
            // make a Primary, Auto-Incrementing field
            $table->increments('id');

            // make two columns: `created_at` and `updated_at` to keep track of
            // changes to a row
            $table->timestamps();

            // `post_id` and `user_id` will be foreign keys, so they have to
            // be unsigned
            // Note how the field names here correspond to the tables they will
            // connect...
            // `post_id` will reference the `posts` table and `user_id` will
            // reference the `users` table
            $table->integer('post_id')->unsigned();
            $table->integer('user_id')->unsigned();

            // make foreign keys
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('users');

            // make compound unique columns 'post_id' and 'user_id'
            $table->unique(['post_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_user');
    }
}
