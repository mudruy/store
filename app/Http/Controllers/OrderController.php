<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\Jobs\PayOrder;

class OrderController extends Controller {

    /**
     * Json REST store for Order
     * @param OrderRequest $request
     * @return array
     */
    public function store(OrderRequest $request) :array {
        $order = Order::createOrder($request->validated());
        return ['order_id' => $order->id];
    }

    /**
     * Json REST update for Order
     * @param OrderRequest $request
     * @param int $id
     */
    public function update(OrderRequest $request, $id) {
        //$order_id, $sum
        extract($request->validated());
        
        $order = Order::find($order_id);
        $this->dispatch(new PayOrder($order));
    }

}
