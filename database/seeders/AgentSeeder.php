<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/agents.php');

        foreach($agents as $a) {
            Agent::create([
                'country_id'  => $a['country_id'],
                'category_id' => $a['category_id'],
                'min_price'   => $a['min_price'],
                'max_price'   => $a['max_price'],
                'fee'         => $a['fee']
            ]);
        }
    }
}
