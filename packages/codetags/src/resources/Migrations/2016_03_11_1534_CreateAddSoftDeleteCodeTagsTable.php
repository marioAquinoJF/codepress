<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddSoftDeleteCodeTagsTable
{

    public function up()
    {
        Schema::table('code_tags', function(Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('code_tags', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }

}
