<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = ['name', 'price'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * return decimal/string Product price
     * @return string
     */
    public function getPrice() :string{
        return $this->price;
    } 
    
    /**
     * many to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders() {
        return $this->belongsToMany(
            'App\Order',
            'order_product',
            'product_id',
            'order_id'
        );
    }
}
