<?php

namespace App\Console\Commands;

use App\Models\Warehouse;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class WarehouseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'warehouse:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize Warehouse In Ventura';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $header = [
            'Authorization' => 'f59c6dfc05dc8f3614e73bab8ba9e7fd8482d3aa05f7d8ebdc66b9fc0bbf40f5a155f1a4f80d20507a27481d58c418671432e712e764e787af9acc1faebf2f05'
        ];

        $get_page   = json_decode(Http::withHeaders($header)->post('http://203.161.31.109/ventura/warehouse'));
        $total_page = $get_page->result->total_page;

        for($i = 1; $i <= $total_page; $i++) {
            $warehouse = json_decode(Http::withHeaders($header)->post('http://203.161.31.109/ventura/warehouse', [
                'page' => $i
            ]));

            foreach($warehouse->result->data as $w) {
                Warehouse::updateOrCreate([
                    'code'   => $w->kode,
                    'name'   => $w->nama
                ], [
                    'status' => $w->isaktif == 1 ? 1 : 2
                ]);
            }
        }
    }
}