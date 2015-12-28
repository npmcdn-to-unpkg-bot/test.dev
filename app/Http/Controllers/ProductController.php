<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{


    public function index(){

        $products=Product::all();

        return \Response::make(view('products.list')->with('products',$products));


    }

}
