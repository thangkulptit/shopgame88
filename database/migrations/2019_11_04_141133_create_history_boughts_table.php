<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryBoughtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_boughts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid');
            $table->Integer('id_acc');
            $table->string('type_account');
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->string('password2')->nullable();
            $table->string('url_bangchung')->nullable();
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
        Schema::dropIfExists('history_boughts');
    }
}
