<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/brands.php');

        foreach($brands as $b) {
            Brand::create([
                'image'  => $b['image'],
                'code'   => $b['code'],
                'name'   => $b['name'],
                'status' => $b['status']
            ]);
        }
    }
}
