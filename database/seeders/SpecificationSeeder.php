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
        require public_path('website/backup.php');

        foreach($specifications as $s) {
            Specification::insert([
                'id'         => $s['id'],
                'code'       => $s['code'],
                'name'       => $s['name'],
                'status'     => $s['status'],
                'created_at' => $s['created_at'],
                'updated_at' => $s['updated_at'],
                'deleted_at' => $s['deleted_at']
            ]);
        }
    }
}
