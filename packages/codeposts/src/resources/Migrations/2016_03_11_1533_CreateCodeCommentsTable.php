<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeCommentsTable
{

    public function up()
    {
        Schema::create('code_comments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->text('content');
            $table->timestamps();
            $table->foreign('post_id')->references('id')->on("code_posts");
        });
    }

    public function down()
    {
        Schema::drop('code_comments');
    }

}
