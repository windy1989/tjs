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
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('division_id')->constrained('divisions');
            $table->foreignId('surface_id')->nullable()->constrained('surfaces');
            $table->foreignId('color_id')->constrained('colors');
            $table->foreignId('pattern_id')->constrained('patterns');
            $table->foreignId('loading_limit_id')->constrained('loading_limits');
            $table->foreignId('buy_unit_id')->constrained('units');
            $table->foreignId('stock_unit_id')->constrained('units');
            $table->foreignId('selling_unit_id')->constrained('units');
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
