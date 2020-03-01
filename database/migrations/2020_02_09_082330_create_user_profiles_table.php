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
            $table->string('job_name', '50')->nullable()->comment('肩書き');
            $table->string('hobby', '50')->nullable()->comment('趣味');
            $table->string('description', '50')->nullable()->comment('一言コメント');
            $table->string('icon_image_id', '255')->comment('ユーザーアイコンID');
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
