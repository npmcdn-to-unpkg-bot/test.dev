<?php

namespace App\Http\Controllers\Back;

use App\Vacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use  App\Http\Requests\VacancyStoreRequest;

class VacanciesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }


    public function create(){

        return response(view('back.vacancies.create'));

    }

    public function store(VacancyStoreRequest $request){


        $validate=\Validator::make($request->all(),$request->rules(),$request->messages());

        if($validate->fails()){

            return redirect('/dashboard/vacancies/create')
                ->withErrors($validate->errors())
                ->withInput();

        }
        else{

            Vacancy::create($request->only('position','description','salary','hot'));

            return redirect()->to('/dashboard/vacancies');
        }

    }

    public function edit(){



    }


    public function update(){


    }

}
