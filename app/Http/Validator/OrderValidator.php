<?php

namespace App\Http\Validator;
use App\Order;

class OrderValidator extends \Illuminate\Validation\Validator {

    /**
     * Sum validator according to information expert
     * @param string  $attribute
     * @param mixed $value
     * @param array $parameters
     * @return boolean
     */
    public function validateOrderSum($attribute, $value, $parameters) {
        $order = Order::find($parameters[0]);
        $result = bccomp($order->amount, $value, 2);
        return $result == 0;
    }
    
    /**
     * Status validator
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return boolean
     */
    public function validateOrderNew($attribute, $value, $parameters) {
        $order = Order::find($parameters[0]);
        return $order->status == Order::STATUS_NEW;
    }

}
