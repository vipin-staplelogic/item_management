<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('shop_id')->unsigned()->index();
            $table->integer('shopify_id')->unsigned()->index();
            $table->integer('charge_id')->unsigned()->index();
            $table->string('charge_status');
            $table->timestamps();

            $table->foreign('shop_id')->references('id')->on('shops');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
