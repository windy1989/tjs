<?php

namespace App\Console\Commands;

use App\Models\Stock;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class StockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize Stock In Ventura';

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
        ini_set('memory_limit', '-1');

        $get_page   = json_decode(Http::post('http://203.161.31.109/ventura/item/stock'));
        $total_page = $get_page->result->total_page;

        for($i = 1; $i <= $total_page; $i++) {
            $stock = json_decode(Http::post('http://203.161.31.109/ventura/item/stock', [
                'page'     => $i,
                'per_page' => 1000
            ]));

            foreach($stock->result->data as $s) {
                Stock::updateOrCreate([
                    'warehouse_code' => $s->kode_gudang,
                    'code'           => $s->kode_item,
                    'type'           => $s->tipe_item
                ], [
                    'name'  => $s->nama,
                    'stock' => $s->stok
                ]);
            }
        }
    }
}
