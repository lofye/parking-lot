<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected bool $status;

    public function __construct(float $amount, string $cc_number)
    {
        $this->status = false;
        $this->amount = $amount;
        $this->cc_number = $cc_number;
    }

    public function make(PaymentProcessorInterface $paymentProcessor) : bool
    {
        try {
            $paymentProcessor->process($this->amount, $this->cc_number);//this will throw an exception if it fails
            $this->status = true;
            $this->save();
            return true;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $this->status = false;
            $this->save();
            return false;
        }
    }
}