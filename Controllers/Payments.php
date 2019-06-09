<?php

namespace Controllers;

use Carbon\Carbon;
use Models\Garage;
use Models\Payment;
use Stripe\StripePaymentProcessor;
use Illuminate\Facades\Request;

class PaymentsController extends Controller
{
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