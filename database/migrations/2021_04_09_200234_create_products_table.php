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
            $table->foreignId('type_id')->constrained('types');
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('hs_code_id')->constrained('hs_codes');
            $table->foreignId('brand_id')->constrained('brands');
            $table->foreignId('country_id')->constrained('countries');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->foreignId('grade_id')->constrained('grades');
            $table->double('carton_pallet')->nullable();
            $table->double('carton_pcs')->nullable();
            $table->char('container_standart', 1);
            $table->double('container_stock');
            $table->double('container_max_stock');
            $table->text('description');
            $table->char('check', 1);
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
