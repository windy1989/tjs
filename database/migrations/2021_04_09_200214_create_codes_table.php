<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('company_id');
            $table->bigInteger('division_id');
            $table->bigInteger('surface_id');
            $table->bigInteger('color_id');
            $table->bigInteger('pattern_id');
            $table->bigInteger('specification_id');
            $table->bigInteger('buy_unit_id');
            $table->bigInteger('stock_unit_id');
            $table->bigInteger('selling_unit_id');
            $table->string('image')->nullable();
            $table->string('code')->unique();
            $table->char('quality', 1);
            $table->integer('faces')->nullable();
            $table->double('length')->nullable();
            $table->double('width')->nullable();
            $table->double('price')->nullable();
            $table->boolean('stock')->default(false);
            $table->integer('min_stock');
            $table->integer('max_stock');
            $table->integer('small_stock');
            $table->char('status', 1);
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codes');
    }
}
