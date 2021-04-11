<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/grades.php');

        foreach($grades as $g) {
            Grade::create([
                'code'   => $g['code'],
                'name'   => $g['name'],
                'status' => $g['status']
            ]);
        }
    }
}
