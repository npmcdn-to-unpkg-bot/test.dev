<?php

namespace App\Http\ViewComposers;
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 22.01.2016
 * Time: 11:38
 */
use Illuminate\View\View;
use App\Product;

class ProductsComposer
{


    protected $products;


    public function __construct(Product $products){

        $this->products=$products;

    }


    public function compose(View $view){


        $view->with('count',$this->products->all()->count());

    }

}