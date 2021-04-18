<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Models\ProductShading;
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

        foreach(ProductShading::all() as $ps) {
            $stock = json_decode(Http::retry(3, 100)->post('http://203.161.31.109/ventura/item/stock', [
                'kode_item' => $ps->stock_code,
                'gudang'    => $ps->warehouse_code,
                'per_page'  => 1000
            ]));

            if($stock->result->total_data > 0) {
                foreach($stock->result->data as $s) {
                    $ps->update(['qty' => $s->stok]);
                }
            } else {
                $ps->delete();
            }
        }
    }
}
