<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/categories.php');

        foreach($categories as $c) {
            Category::create([
                'name'      => $c['name'],
                'slug'      => $c['slug'],
                'parent_id' => $c['parent_id'],
                'status'    => $c['status']
            ]);
        }
    }
}
