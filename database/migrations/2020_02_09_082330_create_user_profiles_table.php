<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('nick_name', '30')->nullable()->comment('あだ名');
            $table->string('kana', '30')->nullable()->comment('フリガナ');
            $table->string('job_name', '50')->nullable()->comment('肩書き');
            $table->string('hobby', '50')->nullable()->comment('趣味');
            $table->string('description', '50')->nullable()->comment('一言コメント');
            $table->uuid('icon_image_id')->nullable()->comment('ユーザーアイコンID');
            $table->uuid('background_image_id')->nullable()->comment('背景画像');
            $table->string('web_address', '255')->nullable()->comment('ユーザーサイト');
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
        Schema::dropIfExists('user_profiles');
    }
}
