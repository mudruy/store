<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;

class ProductController extends Controller {


    public function index()
    {
        return Product::all();
    }
}
