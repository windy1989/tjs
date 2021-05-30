<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('division_id');
            $table->bigInteger('surface_id')->nullable();
            $table->bigInteger('color_id');
            $table->bigInteger('pattern_id');
            $table->bigInteger('loading_limit_id');
            $table->bigInteger('buy_unit_id');
            $table->bigInteger('stock_unit_id');
            $table->bigInteger('selling_unit_id');
            $table->string('image')->nullable();
            $table->string('code')->unique();
            $table->char('material', 1);
            $table->string('faces')->nullable();
            $table->double('length')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('weight');
            $table->double('thickness')->nullable();
            $table->double('conversion');
            $table->boolean('stockable')->default(false);
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
        Schema::dropIfExists('types');
    }
}
