<?php

namespace Database\Seeders;

use App\Models\Freight;
use Illuminate\Database\Seeder;

class FreightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/freights.php');

        foreach($freights as $f) {
            Freight::create([
                'country_id' => $f['country_id'],
                'city_id'    => $f['city_id'],
                'container'  => $f['container'],
                'shipping'   => $f['shipping'],
                'cost'       => $f['cost']
            ]);
        }
    }
}
