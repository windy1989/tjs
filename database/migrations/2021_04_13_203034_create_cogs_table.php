<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('currency_id');
            $table->bigInteger('city_id');
            $table->bigInteger('import_id');
            $table->double('price_profile_custom')->default(0);
            $table->double('agent_fee_usd')->default(0);
            $table->char('shipping', 1);
            $table->double('ls_cost_document')->default(0);
            $table->double('number_container')->default(0);
            $table->double('sni_cost')->default(0);
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
        Schema::dropIfExists('cogs');
    }
}
