<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Order extends Model {

    protected $fillable = ['status', 'amount'];
    protected $hidden = ['created_at', 'updated_at'];

    CONST STATUS_NEW = 'NEW';
    CONST STATUS_PAID = 'PAID';

    /**
     * create Order
     * @param array $request_data
     * @return \App\Order
     */
    public static function createOrder(array $request_data): Order {
        $products = Product::find($request_data['product']);
        $sum = '0';
        bcscale(2);
        foreach ($products as $product) {
            $sum = bcadd($sum, $product->getPrice());
            $order_products[] = $product->id;
        }
        $order = self::create([
            'amount' => $sum,
            'status' => self::STATUS_NEW
        ]);
        $order->products()->saveMany($products);
        return $order;
    }

    /**
     * make Order paid
     * @return void
     */
    public function payOrder() {
        $this->status = self::STATUS_PAID;
        $this->save();
    }

    /**
     * many to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products() {
        return $this->belongsToMany(
            'App\Product', 'order_product', 'order_id', 'product_id'
        );
    }

}
