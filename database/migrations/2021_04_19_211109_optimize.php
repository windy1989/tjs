<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Optimize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->index('country_id'); 
            $table->index('category_id'); 
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->index('image'); 
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->index('image'); 
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('parent_id'); 
        });

        Schema::table('cogs', function (Blueprint $table) {
            $table->index('product_id'); 
            $table->index('currency_id'); 
            $table->index('city_id'); 
            $table->index('import_id'); 
        });

        Schema::table('currency_prices', function (Blueprint $table) {
            $table->index('product_id'); 
            $table->index('currency_id'); 
        });

        Schema::table('currency_rates', function (Blueprint $table) {
            $table->index('currency_id'); 
            $table->index('company_id'); 
        });

        Schema::table('emkls', function (Blueprint $table) {
            $table->index('company_id'); 
            $table->index('import_id'); 
            $table->index('country_id'); 
            $table->index('city_id'); 
        });

        Schema::table('emkl_rates', function (Blueprint $table) {
            $table->index('company_id'); 
            $table->index('currency_id'); 
        });

        Schema::table('freights', function (Blueprint $table) {
            $table->index('country_id'); 
            $table->index('city_id'); 
        });

        Schema::table('marketing_structures', function (Blueprint $table) {
            $table->index('company_id'); 
        });

        Schema::table('pricing_policies', function (Blueprint $table) {
            $table->index('product_id'); 
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index('type_id'); 
            $table->index('company_id'); 
            $table->index('hs_code_id'); 
            $table->index('brand_id'); 
            $table->index('country_id'); 
            $table->index('supplier_id'); 
            $table->index('grade_id'); 
        });

        Schema::table('product_shadings', function (Blueprint $table) {
            $table->index('product_id'); 
            $table->index('warehouse_code'); 
        });

        Schema::table('suppliers', function (Blueprint $table) {
            $table->index('country_id'); 
        });

        Schema::table('supplier_currencies', function (Blueprint $table) {
            $table->index('supplier_id'); 
            $table->index('currency_id'); 
        });

        Schema::table('types', function (Blueprint $table) {
            $table->index('category_id'); 
            $table->index('division_id'); 
            $table->index('surface_id'); 
            $table->index('color_id'); 
            $table->index('pattern_id'); 
            $table->index('loading_limit_id'); 
            $table->index('buy_unit_id'); 
            $table->index('stock_unit_id'); 
            $table->index('selling_unit_id'); 
            $table->index('image'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
