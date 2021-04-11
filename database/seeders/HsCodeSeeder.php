<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\HsCode;
use Illuminate\Database\Seeder;

class HsCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/hs_codes.php');

        foreach($hs_codes as $hc) {
            HsCode::create([
                'code'   => $hc['code'],
                'name'   => $hc['name'],
                'alias'  => $hc['alias'],
                'status' => $hc['status']
            ]);
        }
    }
}
