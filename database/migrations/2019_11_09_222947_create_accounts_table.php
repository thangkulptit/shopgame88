<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('acc_id');
            $table->Integer('type_account');
            $table->string('username');
            $table->string('password');
            $table->string('password2')->nullable();
            $table->mediumText('url_image');
            $table->string('content');
            $table->string('count_champs')->nullable();
            $table->string('count_skins')->nullable();
            $table->string('count_ngoc')->nullable();
            $table->string('rank')->nullable();
            $table->string('da_quy')->nullable();
            $table->string('url_champs')->nullable();
            $table->string('url_skins')->nullable();
            $table->string('url_ngocs')->nullable();
            $table->string('url_bangchung')->nullable();
            $table->string('vip_level')->nullable();
            $table->string('vip_name')->nullable();
            $table->string('vip_content')->nullable();
            $table->string('vip_main')->nullable();
            $table->Integer('status');
            $table->Integer('price');
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
        Schema::dropIfExists('accounts');
    }
}
