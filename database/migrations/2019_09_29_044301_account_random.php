<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccountRandom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_random', function (Blueprint $table) {
            $table->bigIncrements('acc_id');
            $table->string('type_account');
            $table->string('username');
            $table->string('password');
            $table->mediumText('url_image');
            $table->float('price', 30, 2);
            $table->string('content');
            $table->Integer('status');
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
        Schema::dropIfExists('account_random');
    }
}
