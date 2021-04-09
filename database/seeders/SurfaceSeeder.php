<?php

namespace Database\Seeders;

use App\Models\Surface;
use Illuminate\Database\Seeder;

class SurfaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/surfaces.php');

        foreach($surfaces as $s) {
            Surface::create([
                'code'   => $s['code'],
                'name'   => $s['name'],
                'status' => $s['status']
            ]);
        }
    }
}
