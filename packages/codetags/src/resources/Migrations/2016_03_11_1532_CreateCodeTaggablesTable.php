<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeTaggablesTable
{

    public function up()
    {
        Schema::create('code_taggables', function(Blueprint $table) {
            $table->integer('tag_id')->usigned();
            $table->integer('taggable_id')->usigned();
            $table->string('taggable_type');
        });
    }

    public function down()
    {
        Schema::drop('code_taggables');
    }

}
