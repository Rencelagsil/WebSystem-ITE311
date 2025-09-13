<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('pages/home'); // Homepage
    }

    public function about()
    {
        return view('pages/about'); // About page
    }

    public function contact() // Contact page
    {
        return view('pages/contact');
    }

}
