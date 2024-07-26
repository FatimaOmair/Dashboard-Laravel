<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTagTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('product_tag')) {
            Schema::create('product_tag', function (Blueprint $table) {
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('tag_id');
                $table->primary(['product_id', 'tag_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('product_tag');
    }
}

