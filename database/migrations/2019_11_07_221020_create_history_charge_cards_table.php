<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryChargeCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_charge_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid');
            $table->string('type_card');
            $table->string('amount_card');
            $table->string('seri_card');
            $table->string('code_card');
            $table->string('status');
            $table->string('order_by')->nullable();
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
        Schema::dropIfExists('history_charge_cards');
    }
}
