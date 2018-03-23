<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function index()
    {
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function about()
    {
        //return 'This is information about Cost calculator';
        return view('home.about');

    }

    public function contact()
    {
        return view('home.contact')->with([
            'email' => config('app.supportEmail')
        ]);
    }

}
