<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('storage_id', '50')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('title', '50')->comment('作品名');
            $table->string('description', '50')->nullable()->comment('一言コメント');
            $table->longText('long_comment')->nullable()->comment('長文コメント');
            $table->string('storage_url', '255')->nullable()->comment('ストレージURL');
            $table->string('eyecatch_imgae_url', '255')->comment('アイキャッチ画像URL');
            $table->string('web_address', '255')->comment('WEB Address');
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
        Schema::dropIfExists('storages');
    }
}
