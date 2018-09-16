<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNaviInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navi_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->json('label')->nullable()->comment('标签');
            $table->string('name')->default('')->comment('名称');
            $table->string('url')->default('')->comment('URL地址');
            $table->json('detail')->nullable()->comment('详情');
            $table->softDeletes();
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
        Schema::dropIfExists('navi_infos');
    }
}
