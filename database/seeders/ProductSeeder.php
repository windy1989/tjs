<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductShading;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/products.php');
        require public_path('backup/product_shadings.php');

        foreach($products as $p) {
            Product::create([
                'type_id'             => $p['type_id'],
                'company_id'          => $p['company_id'],
                'hs_code_id'          => $p['hs_code_id'],
                'brand_id'            => $p['brand_id'],
                'country_id'          => $p['country_id'],
                'supplier_id'         => $p['supplier_id'],
                'grade_id'            => $p['grade_id'],
                'carton_pallet'       => $p['carton_pallet'],
                'carton_pcs'          => $p['carton_pcs'],
                'carton_sqm'          => $p['carton_sqm'],
                'selling_unit'        => $p['selling_unit'],
                'cubic_meter'         => $p['cubic_meter'],
                'container_standart'  => $p['container_standart'],
                'container_stock'     => $p['container_stock'],
                'container_max_stock' => $p['container_max_stock'],
                'description'         => $p['description'],
                'status'              => $p['status']
            ]);
        }

        foreach($product_shadings as $ps) {
            ProductShading::create([
                'product_id'     => $ps['product_id'],
                'warehouse_code' => $ps['warehouse_code'],
                'code'           => $ps['code'],
                'qty'            => $ps['qty']
            ]);
        }
    }
}
