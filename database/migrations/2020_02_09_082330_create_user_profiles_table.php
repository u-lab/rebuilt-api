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
            $table->string('nick_name', '30')->comment('あだ名');
            $table->string('job_name', '50')->comment('肩書き');
            $table->string('hobby', '50')->comment('趣味');
            $table->string('description', '50')->comment('一言コメント');
            $table->string('icon_image_url', '255')->comment('ユーザーアイコン');
            $table->string('web_address', '255')->comment('ユーザーサイト');
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
