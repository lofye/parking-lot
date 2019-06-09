<?php

namespace Controllers;

use Carbon\Carbon;
use Models\Garage;
use Models\Ticket;
use Illuminate\Facades\Request;

class TicketsController extends Controller
{

    public function store(Request $request)
    {
        $garage = Garage::find(config('app.garage_id'));

        if (!$garage->hasSpacesAvailable()) {
            throw new Exception('There are currently no parking spaces available.');
        }

        $ticket = new Ticket($garage);
        $ticket->distribute();

        return $ticket;
    }

    public function show(Ticket $ticket)
    {
        return $ticket->show();
    }

}