<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($companies as $c) {
            Company::create([
                'code'   => $c['code'],
                'name'   => $c['name'],
                'status' => $c['status']
            ]);
        }
    }
}
