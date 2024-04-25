<?php

namespace App\Console\Commands;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Console\Command;

class OrderTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $hora = now()->subMinute(1);

        $orders = Order::where('status', 1)->whereTime('created_at', '<=', $hora)->get();

        foreach ($orders as $order) {

            $items = json_decode($order->content);

            foreach ($items as $item) {
                increase($item);
            }

            $order->status = 5;

            $order->save();
        }
        // return Command::SUCCESS;
    }
}
