<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->id('customer_id');
            $table->id('code');
            $table->id('discount');
            $table->id('subtotal');
            $table->id('grandtotal');
            $table->id('payment');
            $table->id('change');
            $table->id('bottom_price');
            $table->id('showroom_cost');
            $table->id('marketing_cost');
            $table->id('fixed_cost');
            $table->id('fixed_cost');
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
        Schema::dropIfExists('orders');
    }
}
