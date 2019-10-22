<?php

namespace App\Http\Validator;
use App\Order;

class OrderValidator extends \Illuminate\Validation\Validator {

    public function validateOrderSum($attribute, $value, $parameters) {
        $order = Order::find($parameters[0]);
        $result = bccomp($order->amount, $value, 2);
        return $result == 0;
    }
    
    public function validateOrderNew($attribute, $value, $parameters) {
        $order = Order::find($parameters[0]);
        return $order->status == Order::STATUS_NEW;
    }

}
