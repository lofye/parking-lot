<?php

namespace App\Http\Controllers\Api;

use App\Models\Garage;
use App\Models\Ticket;
use App\Services\StripePaymentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Payment;

class PaymentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ticket $ticket)
    {
        $garage = Garage::find(config('app.garage_id'));

        $ticket->recordExit();

        $succeed_payment = (bool) $request->input('succeed',true);
        $cc_number = (string) $request->input('cc_number');


        \Log::info('ticket: '.var_export($ticket->show($garage),true));

        $amount_due = $ticket->getAmountDue($garage, false);
        $formatted_due = $ticket->getAmountDue($garage);

        \Log::info('XXXX: '.$formatted_due.' - '.$cc_number.' - '.$succeed_payment); //**** WHY IS THIS ZERO ??? ****//

        $payment = new Payment($amount_due, $cc_number);
        $payment->ticket_id = $ticket->id;

        $paymentProcessor = new StripePaymentService($succeed_payment);

        if(!$payment->make($paymentProcessor)){
            return response()->json(['error' => 'Transaction Failed. Unable to pay: '.$formatted_due], 417);
        }

        $ticket->markAsPaid($garage);

        return response()->json(['message' => 'Thank you for your payment of '.$formatted_due], 200);
    }
}