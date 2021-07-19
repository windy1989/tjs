<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\CustomerPoint;
use Illuminate\Console\Command;

class StatusOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking status order';

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
        $data = Order::where('status', 1)->get();
        foreach($data as $d) {
            $current_date = strtotime(date('Y-m-d H:i:s'));
            $created_at   = date('Y-m-d H:i:s', strtotime('+1 days', strtotime($d->created_at)));
            $deadline     = strtotime($created_at);

            if($current_date > $deadline) {
                Order::find($d->id)->update(['status' => 5]);
                CustomerPoint::where('customer_id', $d->customer_id)->where('order_id', $d->id)->delete();

                if($order->points > 0) {
                    $pointable      = $d->customer->points;
                    $restore_points = $pointable + $d->points;
                    $order->customer->update(['points' => $restore_points]);
                }
            }
        }

        return true;
    }
}