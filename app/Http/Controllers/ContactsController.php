<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContactsController extends Controller
{


    public function mail(){

        return response(view('front.contact.mail'));

    }

    public function send(){

    }
}
