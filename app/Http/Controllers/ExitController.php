<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client as RestClient;
use App\Models\Ticket;

class ExitController extends Controller
{
    public function index(Request $request)
    {
        $ticket_number = $request->get('ticket_number', false);
        if($ticket_number)
        {
            return redirect('exit/'.$ticket_number);
        }

        return view('home.exit_index');
    }

    public function show(Request $request, Ticket $ticket)
    {
        $client = new RestClient();
        $response = $client->request('GET', 'https://parking-lot.test/api/tickets/'.$ticket->id, ['verify' => false]);

        $body = (object) json_decode($response->getBody()->getContents(),true);

        if(isset($body->error)){
            $message = $body->error;
        } else {
            $message = 'Ticket: '.$body->id.' :: Hours: '.$body->duration.' :: Amount Due: '.$body->amount_due;
        }

        return view('home.exit_form', ['message' => $message, 'ticket_number' => $ticket->id]);
    }

    public function store(Request $request, Ticket $ticket)
    {
        try{
            $client = new RestClient();
            $response = $client->request('POST', 'https://parking-lot.test/api/payments/'.$ticket->id,
                [
                    'verify' => false,
                    'form_params' => [
                        'succeed' => $request->input('succeed'),
                        'cc_number' => $request->input('cc_number')
                    ]
                ]);
            $body = (object) json_decode($response->getBody()->getContents(),true);

            if(isset($body->error)){
                $message = $body->error;
            } else {
                $message = $body->message;
            }
            $success = true;

        }catch(\Exception $e)
        {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = json_decode($response->getBody()->getContents());
                $message = $body->error;
            } else {
                $message = 'Unknown Error';
            }
            $success = false;
        }


        return view('home.exit', ['message' => $message, 'success' => $success]);
    }
}
