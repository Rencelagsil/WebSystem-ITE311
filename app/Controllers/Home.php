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

    public function dashboard()
    {
        $session = session();
        if (! $session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        return view('dashboard/index');
    }
}
