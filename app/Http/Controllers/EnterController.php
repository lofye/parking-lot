<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client as RestClient;

class EnterController extends Controller
{
    public function index()
    {
        $client = new RestClient();
        $response = $client->request('POST', 'https://parking-lot.test/api/tickets', ['verify' => false]);

        $body = (object) json_decode($response->getBody()->getContents(),true);

        if(isset($body->error)){
            $ticket_number = null;
            $message = $body->error;
        } else {
            $ticket_number = $body->id;
            $message = 'Your ticket number is: '.$ticket_number;
        }

        return view('home.enter', ['message' => $message, 'ticket_number' => $ticket_number]);
    }
}
