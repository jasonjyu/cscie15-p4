<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectHashtagsAndUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hashtags', function (Blueprint $table) {
            // add a new INT field called `user_id` that has to be unsigned
            $table->integer('user_id')->unsigned();

            // this field `author_id` is a foreign key that connects to the `id`
            // field in the `users` table
            $table->foreign('user_id')->references('id')->on('users');

            // make compound unique columns 'term' and 'user_id'
            $table->unique(['term', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hashtags', function (Blueprint $table) {
            // ref: http://laravel.com/docs/5.1/migrations#dropping-indexes
            $table->dropUnique('hashtags_term_user_id_unique');

            // ref: http://laravel.com/docs/5.1/migrations#foreign-key-constraints
            $table->dropForeign('hashtags_user_id_foreign');

            $table->dropColumn('user_id');
        });
    }
}
