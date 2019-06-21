<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use Illuminate\Http\Request;
use GuzzleHttp\Client as RestClient;

class HomeController extends Controller
{
    public function __invoke()
    {
        $garage = Garage::find(config('app.garage_id'));

        return view('home.invoke', ['show_enter' => $garage->hasSpacesAvailable(), 'show_exit' => $garage->hasOccupiedSpaces()]);
    }
}
