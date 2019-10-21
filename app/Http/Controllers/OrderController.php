<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Order;

class OrderController extends Controller
{
    
    public function store(OrderRequest $request)
     {
         $order = Order::createOrder($request->validated());
         return ['order_id' => $order->id];
     }
}
