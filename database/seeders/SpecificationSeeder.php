<?php

namespace Database\Seeders;

use App\Models\Specification;
use Illuminate\Database\Seeder;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/specifications.php');

        foreach($specifications as $s) {
            Specification::create([
                'code'   => $s['code'],
                'name'   => $s['name'],
                'status' => $s['status']
            ]);
        }
    }
}
