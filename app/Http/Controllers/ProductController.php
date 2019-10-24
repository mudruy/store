<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;

class ProductController extends Controller {


    /**
     * Json REST index for Product
     * @return array
     */
    public function index()
    {
        return Product::all();
    }
}
