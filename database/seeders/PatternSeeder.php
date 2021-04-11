<?php

namespace Database\Seeders;

use App\Models\Pattern;
use Illuminate\Database\Seeder;

class PatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/patterns.php');

        foreach($patterns as $p) {
            Pattern::create([
                'code'   => $p['code'],
                'name'   => $p['name'],
                'status' => $p['status']
            ]);
        }
    }
}
