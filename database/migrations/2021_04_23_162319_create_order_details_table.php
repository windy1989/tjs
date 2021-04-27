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
            $table->bigInteger('order_id');
            $table->bigInteger('product_id');
            $table->double('showroom_cost')->nullable();
            $table->double('marketing_cost')->nullable();
            $table->double('bottom_price')->nullable();
            $table->double('fixed_cost')->nullable();
            $table->double('price_list');
            $table->double('cogs_perwira')->nullable();
            $table->double('cogs_smartmarble')->nullable();
            $table->double('profit')->nullable();
            $table->integer('qty');
            $table->integer('ready')->default(0);
            $table->integer('indent')->default(0);
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