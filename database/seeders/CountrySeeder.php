<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/countries.php');

        foreach($countries as $c) {
            Country::create([
                'code'       => $c['code'],
                'name'       => $c['name'],
                'phone_code' => $c['phone_code'],
                'status'     => $c['status']
            ]);
        }
    }
}
