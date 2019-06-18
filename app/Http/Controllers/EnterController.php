<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnterController extends Controller
{
    public function index()
    {
        return view('home.enter');
    }
}
