<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // make a Primary, Auto-Incrementing field
            $table->increments('id');

            // make two columns: `created_at` and `updated_at` to keep track of
            // changes to a row
            $table->timestamps();

            // make the rest of the columns...
            $table->string('feed');
            $table->string('posted_id');
            $table->timestamp('posted_at');
            $table->string('text');
            $table->string('uri');

            // make compound unique columns 'feed' and 'posted_id'
            $table->unique(['feed', 'posted_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
