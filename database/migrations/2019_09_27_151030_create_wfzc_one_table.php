<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWfzcOneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wfzc_one', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id');
            $table->integer('category');
            $table->integer('content_type');
            $table->string('date', 30);
            $table->string('title', 200);
            $table->text('url');
            $table->text('img_url');
            $table->string('picture_author', 200);
            $table->text('content');
            $table->string('text_authors', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wfzc_one');
    }
}
