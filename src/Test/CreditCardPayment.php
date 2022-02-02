<?php

declare(strict_types=1);

namespace App\Test;

class CreditCardPayment implements PaymentProvider
{
    public function pay(float $amount): void
    {
    }
}
