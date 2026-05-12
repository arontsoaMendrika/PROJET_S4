<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // If user is not logged in, show the login page first
        if (! session()->get('user_id')) {
            return redirect()->to('/login');
        }

        return view('welcome_message');
    }
}
