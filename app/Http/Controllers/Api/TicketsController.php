<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Garage;
use App\Models\Ticket;
use Illuminate\Facades\Request;

class TicketsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return $ticket->show();
    }

}