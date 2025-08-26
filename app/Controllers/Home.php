<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home'); // Homepage
    }

    public function about()
    {
        return view('about'); // About page
    }

    public function contact() // Contact page
    {
        return view('contact');
    }
}
