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
            $table->bigInteger('customer_id');
            $table->json('xendit')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('number')->unique();
            $table->string('sales_order')->nullable();
            $table->string('invoice')->nullable();
            $table->string('purchase_order')->nullable();
            $table->double('discount')->default(0);
            $table->double('subtotal')->default(0);
            $table->double('shipping')->default(0);
            $table->double('grandtotal')->default(0);
            $table->double('payment')->default(0);
            $table->double('change')->default(0);
            $table->text('description')->nullable();
            $table->char('type', 1);
            $table->char('status', 1);
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
