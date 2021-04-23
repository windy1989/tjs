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
        Customer::create([
            'name'         => 'Calvin Dito Pratama',
            'email'        => 'calvindito7@gmail.com',
            'phone'        => '088999157717',
            'password'     => bcrypt('123456'),
            'verification' => date('Y-m-d H:i:s')
        ]);
    }
}
