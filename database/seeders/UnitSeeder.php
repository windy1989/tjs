<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/units.php');

        foreach($units as $u) {
            Unit::create([
                'code'   => $u['code'],
                'name'   => $u['name'],
                'status' => $u['status']
            ]);
        }
    }
}
