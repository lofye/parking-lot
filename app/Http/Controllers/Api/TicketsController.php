<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Exception;
use App\Models\Garage;
use App\Models\Ticket;

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
            return response()->json(['error' => 'There are currently no parking spaces available.'], 412);
        }

        $ticket = new Ticket();
        $ticket->distribute($garage);

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
        $garage = Garage::find(config('app.garage_id'));

        return $ticket->show($garage);
    }

}