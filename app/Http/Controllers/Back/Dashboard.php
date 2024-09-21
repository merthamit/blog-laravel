<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        return view('back.dashboard');
    }
}
