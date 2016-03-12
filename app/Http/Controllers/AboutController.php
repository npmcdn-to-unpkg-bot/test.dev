<?php

namespace App\Http\Controllers;

use App\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class AboutController extends Controller
{
    public function awards(){
        return response(view('front.about.awards'))->setExpires(Carbon::now()->addDay(7));
    }

    public function vacancies(){

        $vacancies=Vacancy::all();

        return response(view('front.about.vacancies',compact('vacancies')))->setExpires(Carbon::now()->addHour());
    }


}
