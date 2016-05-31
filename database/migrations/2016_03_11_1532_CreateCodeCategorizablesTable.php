<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeCategorizablesTable
{

    public function up()
    {
        Schema::create('code_categorizables', function(Blueprint $table) {
            $table->integer('category_id')->usigned();
            $table->integer('categorizable_id')->usigned();
            $table->string('categorizable_type');
        });
    }

    public function down()
    {
        Schema::drop('code_categorizables');
    }

}
