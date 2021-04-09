<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/colors.php');

        foreach($colors as $c) {
            Color::create([
                'code'   => $c['code'],
                'name'   => $c['name'],
                'status' => $c['status']
            ]);
        }
    }
}
