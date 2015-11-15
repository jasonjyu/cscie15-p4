<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtags', function (Blueprint $table) {
            // make a Primary, Auto-Incrementing field
            $table->increments('id');

            // make two columns: `created_at` and `updated_at` to keep track of
            // changes to a row
            $table->timestamps();

            // make the rest of the columns...
            $table->string('term')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hashtags');
    }
}
