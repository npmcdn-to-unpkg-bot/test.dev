<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{


    public function index(){

        $products=Product::with('categories')->get();

        return response()->view('front.catalog.list',compact('products'));

    }

}
