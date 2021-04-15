<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_id');
            $table->bigInteger('company_id');
            $table->bigInteger('hs_code_id');
            $table->bigInteger('brand_id');
            $table->bigInteger('country_id');
            $table->bigInteger('supplier_id');
            $table->bigInteger('grade_id');
            $table->double('carton_pallet')->nullable();
            $table->double('carton_pcs')->nullable();
            $table->double('carton_sqm')->nullable();
            $table->double('cubic_meter');
            $table->char('container_standart', 1);
            $table->double('container_stock');
            $table->double('container_max_stock');
            $table->text('description');
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
        Schema::dropIfExists('products');
    }
}
