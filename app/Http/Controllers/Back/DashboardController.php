<?php

namespace App\Http\Controllers\Back;

use App\Category;
use App\User;
use App\Vacancy;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }


    public function index(){

         return view('back.index');

    }


    public function products(){

        return view('back.products.index');

    }

    public function categories(){

        $categories=Category::defaultOrder()->get();

        return view('back.categories.index',compact('categories'));
    }

    public function vacancies(){

        $vacancies=Vacancy::all();

        return response(view('back.vacancies.index',compact('vacancies')));

    }

}