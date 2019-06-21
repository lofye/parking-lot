<?php

namespace App\Services;

use App\Interfaces\PaymentProcessorInterface;

class StripePaymentService implements PaymentProcessorInterface
{
    protected $succeed_or_fail;

    public function __construct(bool $succeed_or_fail)
    {
        $this->succeed_or_fail = $succeed_or_fail;
    }

    public function process(float $amount, string $cc_number)
    {
        return $this->succeed_or_fail;
    }
}