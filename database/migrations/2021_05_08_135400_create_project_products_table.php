<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('qty');
            $table->double('cogs')->default(0);
            $table->double('price',20,2);
            $table->double('target_price',20,2);
            $table->double('recommended_price',20,2)->default(0);
            $table->double('discount',20,2)->nullable();
            $table->char('unit', 1);
            $table->date('delivery')->nullable();
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
        Schema::dropIfExists('project_products');
    }
}
