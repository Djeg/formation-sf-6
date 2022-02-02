<?php

declare(strict_types=1);

namespace App\Test;

interface PaymentProvider
{
    public function pay(float $amount): void;
}
