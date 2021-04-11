<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use App\Models\SupplierCurrency;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/suppliers.php');
        require public_path('backup/supplier_currencies.php');

        foreach($suppliers as $s) {
            Supplier::create([
                'country_id'      => $s['country_id'],
                'code'            => $s['code'],
                'name'            => $s['name'],
                'email'           => $s['email'],
                'phone'           => $s['phone'],
                'address'         => $s['address'],
                'pic'             => $s['pic'],
                'limit_credit'    => $s['limit_credit'],
                'term_of_payment' => $s['term_of_payment'],
                'status'          => $s['status']
            ]);
        }

        foreach($supplier_currencies as $sc) {
            SupplierCurrency::create([
                'supplier_id' => $sc['supplier_id'],
                'currency_id' => $sc['currency_id']
            ]);
        }
    }
}
