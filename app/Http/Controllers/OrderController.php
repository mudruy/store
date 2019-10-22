<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\Jobs\PayOrder;

class OrderController extends Controller {

    public function store(OrderRequest $request) {
        $order = Order::createOrder($request->validated());
        return ['order_id' => $order->id];
    }

    public function update(OrderRequest $request, $id) {
        //$order_id, $sum
        extract($request->validated());
        
        $order = Order::find($order_id);
        $this->dispatch(new PayOrder($order));
    }

}
