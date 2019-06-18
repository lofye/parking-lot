<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExitController extends Controller
{
    public function index()
    {
        return view('home.exit');
    }
}
