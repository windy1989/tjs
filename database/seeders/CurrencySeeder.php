<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/currencies.php');

        foreach($currencies as $c) {
            Currency::create([
                'code'   => $c['code'],
                'name'   => $c['name'],
                'symbol' => $c['symbol'],
                'status' => $c['status']
            ]);
        }
    }
}
