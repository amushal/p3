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
        return 'This is information about Cost calculator';
    }

    public function contact()
    {
        return 'Questions? Email us at ' . Config::get('app.supportEmail');
    }

}
