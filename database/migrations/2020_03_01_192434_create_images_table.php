<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('image ID');
            $table->string('title', 255)->comment('画像名');
            $table->string('url', 255)->comment('オリジナル画像');
            $table->string('url_160', 255)->nullable()->comment('width = 160');
            $table->string('url_320', 255)->nullable()->comment('width = 320');
            $table->string('url_640', 255)->nullable()->comment('width = 640');
            $table->string('url_1024', 255)->nullable()->comment('width = 1024');
            $table->string('url_1280', 255)->nullable()->comment('width = 1280');
            $table->string('url_1920', 255)->nullable()->comment('width = 1920');
            $table->string('url_2580', 255)->nullable()->comment('width = 2580');
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
        Schema::dropIfExists('images');
    }
}
