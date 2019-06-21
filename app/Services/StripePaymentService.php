<?php

namespace App\Services;

use App\Interfaces\PaymentProcessorInterface;

class StripePaymentService implements PaymentProcessorInterface
{
    protected $succeed_or_fail;

    public function __construct($succeed_or_fail)
    {
        $this->succeed_or_fail = $succeed_or_fail;
    }

    public function process(float $amount, string $cc_number)
    {
        if($this->succeed_or_fail)
        {
            return true;
        } else
        {
            false;
        }
    }
}