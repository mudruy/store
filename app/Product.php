<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = ['name', 'price'];
    protected $hidden = ['created_at', 'updated_at'];

}
