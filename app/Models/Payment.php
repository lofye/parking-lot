<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\PaymentProcessorInterface;

class Payment extends Model
{
    public function __construct(float $amount, string $cc_number)
    {
        $this->status = false;
        $this->amount = $amount;
        $this->cc_number = $cc_number;
    }

    public function make(PaymentProcessorInterface $paymentProcessor) : bool
    {
        $this->status = $paymentProcessor->process($this->amount, $this->cc_number);
        $this->save();
        return $this->status;
    }
}