<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{

    public  function  index(){

        return response()->view('front.index');

    }





    public function about(){

        return response()->view('front.about');

    }



    public function news(){

  return response()->view('front.news');

    }

    public function contacts(){

        return response()->view('front.contact');

    }

}
