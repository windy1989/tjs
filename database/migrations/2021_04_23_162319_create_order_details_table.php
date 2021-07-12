<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->constrained('products');
            $table->double('showroom_cost')->nullable();
            $table->double('marketing_cost')->nullable();
            $table->double('bottom_price')->nullable();
            $table->double('fixed_cost')->nullable();
            $table->double('price_list');
            $table->double('target_price');
            $table->double('cogs_perwira')->nullable();
            $table->double('cogs_smartmarble')->nullable();
            $table->double('profit')->nullable();
            $table->date('partial_delivery')->nullable();
            $table->integer('qty');
            $table->double('total');
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
        Schema::dropIfExists('order_details');
    }
}
