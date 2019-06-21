<?php

namespace App\Interfaces;

interface PaymentProcessorInterface
{
    public function process(float $amount, string $cc_number);
}