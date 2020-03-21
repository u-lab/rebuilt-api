<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('last_name', '50')->nullable()->comment('性');
            $table->string('first_name', '50')->nullable()->comment('名');
            $table->string('last_kana', '50')->nullable()->comment('セイ');
            $table->string('first_kana', '50')->nullable()->comment('メイ');
            $table->string('school_name', '100')->nullable()->comment('学校名');
            $table->date('birthday')->nullable()->comment('誕生日');
            $table->string('prefecture', '20')->nullable()->comment('都道府県');
            $table->string('city', '100')->nullable()->comment('市区町村');
            $table->string('street', '100')->nullable()->comment('その他、アパート等');
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
        Schema::dropIfExists('user_infos');
    }
}
