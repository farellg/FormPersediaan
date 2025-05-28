<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function dashboard()
    {
    return view('dashboard');
    }

}
