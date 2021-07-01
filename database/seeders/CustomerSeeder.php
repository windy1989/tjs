<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($customers as $c) {
            Customer::insert([
                'id'           => $c['id'],
                'photo'        => $c['photo'],
                'name'         => $c['name'],
                'email'        => $c['email'],
                'phone'        => $c['phone'],
                'password'     => $c['password'],
                'verification' => $c['verification'],
                'created_at'   => $c['created_at'],
                'updated_at'   => $c['updated_at']
            ]);
        }
    }
}
