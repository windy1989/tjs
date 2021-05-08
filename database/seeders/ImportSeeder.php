<?php

namespace Database\Seeders;

use App\Models\Import;
use Illuminate\Database\Seeder;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($imports as $i) {
            Import::create([
                'code' => $i['code'],
                'name' => $i['name']
            ]);
        }
    }
}
