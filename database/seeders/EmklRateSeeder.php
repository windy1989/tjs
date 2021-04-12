<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmklRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('backup/emkl_rates.php');

        foreach($emkl_rates as $er) {
            EmklRate::insert([
                'company_id'  => $er['company_id'],
                'currency_id' => $er['currency_id'],
                'conversion'  => $er['conversion'],
                'created_at'  => $er['created_at'],
                'updated_at'  => date('Y-m-d H:i:s')
            ]);
        }
    }
}
