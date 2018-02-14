<?php

namespace Tests\Unit;

use App\Payment\PaymentProviderInterface;
use App\Payment\Paypal\PaypalPaymentProvider;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CommonPaymentTests;

class PaypalProviderTest extends TestCase
{
    use CommonPaymentTests;

    private function getProvider()
    {
        return new PaypalPaymentProvider();
    }
}
