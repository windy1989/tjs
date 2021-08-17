<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Optimize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE brands ADD FULLTEXT brands_name_fulltext(name)");
        DB::statement("ALTER TABLE categories ADD FULLTEXT categories_name_fulltext(name)");
        DB::statement("ALTER TABLE countries ADD FULLTEXT countries_name_fulltext(name)");
        DB::statement("ALTER TABLE colors ADD FULLTEXT colors_name_fulltext(name)");
        DB::statement("ALTER TABLE types ADD FULLTEXT types_code_fulltext(code)");

        Schema::table('agents', function (Blueprint $table) {
            $table->index('country_id'); 
            $table->index('category_id'); 
        });

        Schema::table('approvals', function (Blueprint $table) {
            $table->index('user_id'); 
            $table->index('approvalable_type'); 
            $table->index('approvalable_id'); 
        });

        Schema::table('budgetings', function (Blueprint $table) {
            $table->index('coa_id'); 
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->index('customer_id'); 
            $table->index('product_id'); 
        });
        
        Schema::table('cash_banks', function (Blueprint $table) {
            $table->index('user_id'); 
        });

        Schema::table('cash_bank_details', function (Blueprint $table) {
            $table->index('cash_bank_id'); 
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('parent_id'); 
        });

        Schema::table('coas', function (Blueprint $table) {
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

        Schema::table('customer_points', function (Blueprint $table) {
            $table->index('customer_id'); 
            $table->index('order_id'); 
        });

        Schema::table('deliveries', function (Blueprint $table) {
            $table->index('vendor_id'); 
            $table->index('transport_id'); 
            $table->index('destination_id'); 
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

        Schema::table('journals', function (Blueprint $table) {
            $table->index('journalable_type'); 
            $table->index('journalable_id'); 
        });

        Schema::table('marketing_structures', function (Blueprint $table) {
            $table->index('company_id'); 
        });

        Schema::table('news', function (Blueprint $table) {
            $table->index('category_id'); 
            $table->index('user_id'); 
        });

        Schema::table('news_tags', function (Blueprint $table) {
            $table->index('news_id'); 
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->index('user_id'); 
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index('customer_id'); 
            $table->index('voucher_id'); 
        });

        Schema::table('order_deliveries', function (Blueprint $table) {
            $table->index('order_id'); 
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->index('order_id'); 
            $table->index('product_id'); 
        });

        Schema::table('order_payments', function (Blueprint $table) {
            $table->index('order_id');  
        });

        Schema::table('order_pos', function (Blueprint $table) {
            $table->index('order_id');  
        });

        Schema::table('order_shippings', function (Blueprint $table) {
            $table->index('order_id');  
            $table->index('city_id');  
            $table->index('delivery_id');  
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
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->index('user_id'); 
            $table->index('country_id'); 
            $table->index('city_id'); 
        });
        
        Schema::table('project_consultant_meetings', function (Blueprint $table) {
            $table->index('project_id'); 
        });

        Schema::table('project_products', function (Blueprint $table) {
            $table->index('project_id'); 
            $table->index('product_id'); 
        });

        Schema::table('project_samples', function (Blueprint $table) {
            $table->index('project_id'); 
            $table->index('product_id'); 
        });

        Schema::table('project_payments', function (Blueprint $table) {
            $table->index('project_id'); 
        });

        Schema::table('project_productions', function (Blueprint $table) {
            $table->index('project_id'); 
        });

        Schema::table('project_shipments', function (Blueprint $table) {
            $table->index('project_id'); 
        });

        Schema::table('project_delivery', function (Blueprint $table) {
            $table->index('project_id'); 
            $table->index('city_id'); 
            $table->index('delivery_id'); 
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
        });

        Schema::table('wishlists', function (Blueprint $table) {
            $table->index('customer_id'); 
            $table->index('product_id'); 
        });

        Schema::table('product_shadings', function (Blueprint $table) {
            $table->foreign('warehouse_code')->references('code')->on('warehouses');
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
