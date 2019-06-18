<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Garage;
use App\Models\Payment;
use Stripe\StripePaymentProcessor;
use Illuminate\Facades\Request;

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
        $ticket->exit();

        $payment = new Payment($ticket->getAmountDue(), $request->get('cc_num'));

        $paymentProcessor = new StripePaymentProcessor();

        if(!$payment->make($paymentProcessor)){
            throw new Exception('Your credit card was declined. Unable to pay: '.$ticket->getAmountDue());
        }

        $ticket->markAsPaid();

        return json_encode('Thank you for your payment of '.$ticket->getAmountDue());
    }
}