<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodePostsTable
{

    public function up()
    {
        Schema::create('code_posts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('code_posts');
    }

}
