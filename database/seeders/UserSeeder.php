<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Calvin Dito Pratama',
            'email'    => 'calvindito7@gmail.com',
            'password' => bcrypt('123456'),
            'branch'   => 1,
            'status'   => 1
        ]);

        UserRole::create([
            'user_id' => 1,
            'role'    => 1
        ]);
    }
}
