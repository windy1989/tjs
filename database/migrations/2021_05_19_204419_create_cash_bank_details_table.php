<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_bank_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cash_bank_id')->constrained('cash_banks');
            $table->bigInteger('debit');
            $table->bigInteger('credit');
            $table->double('nominal');
            $table->text('note');
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
        Schema::dropIfExists('cash_bank_details');
    }
}
