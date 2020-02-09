<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sns_accounts', function (Blueprint $table) {
            $table->bigIncrements('sns_id');
            $table->string('sns_name', '100')->comment('SNSサービス名');
            $table->string('sns_top_url', '255')->nullable()->comment('SNSのURL');
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
        Schema::dropIfExists('sns_accounts');
    }
}
