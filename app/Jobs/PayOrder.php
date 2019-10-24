<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Order;
use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use GuzzleHttp\Psr7\Request;
use DB;

class PayOrder implements ShouldQueue {

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    protected $_order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order) {
        $this->_order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        DB::beginTransaction();
        $order = Order::lockForUpdate()->find($this->_order->id);
        if ($order->status == Order::STATUS_PAID) {
            DB::rollBack();
            return true;
        }
        if (self::_goUrl('https://ya.ru')) {
            $order->payOrder();
        }
        DB::commit();
    }

    /**
     * make http ping
     * @param string $url
     * @return boolean
     */
    protected static function _goUrl($url) {
        $config = ['timeout' => 5];
        $guzzle = new GuzzleClient($config);
        $adapter = new GuzzleAdapter($guzzle);

        $request = new Request('GET', $url);
        $response = $adapter->sendRequest($request);
        return 200 == $response->getStatusCode();
    }

}
