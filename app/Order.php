<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Order extends Model {

    protected $fillable = ['status', 'amount'];
    protected $hidden = ['created_at', 'updated_at'];
    CONST STATUS_NEW = 'NEW';
    CONST STATUS_PAID = 'PAID';
    

    public static function createOrder($request_data) {
        $products = Product::find($request_data['product']);
        $sum = '0';
        bcscale(2);
        foreach ($products as $product) {
            $sum = bcadd($sum, $product->getPrice());
        }
        return self::create([
            'amount' => $sum,
            'status' => self::STATUS_NEW
        ]);
    }

}
