<?php

namespace Database\Seeders;

use App\Models\TransportType;
use Illuminate\Database\Seeder;

class TransportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($transport_types as $tt) {
            TransportType::insert([
                'id'         => $tt['id'],
                'name'       => $tt['name'],
                'created_at' => $tt['created_at'],
                'updated_at' => $tt['updated_at'],
                'deleted_at' => $tt['deleted_at']
            ]);
        }
    }
}
