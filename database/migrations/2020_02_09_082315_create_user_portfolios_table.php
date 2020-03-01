<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_portfolios', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('masterpiece_storage_id', '50')->comment('代表作品');
            $table->longText('long_comment')->nullable()->comment('本文');
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
        Schema::dropIfExists('user_portfolios');
    }
}
