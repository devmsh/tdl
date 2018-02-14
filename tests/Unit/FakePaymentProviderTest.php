<?php

namespace Tests\Unit;

use App\Payment\Currency;
use App\Payment\FakePaymentProvider;
use App\Payment\PaymentProviderInterface;
use App\Payment\PaymentProviderNoRefundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\CommonPaymentTests;

class FakePaymentProviderTest extends TestCase
{
    use CommonPaymentTests;

    private function getProvider()
    {
        return new FakePaymentProvider();
    }

    public function test_can_retrieve_latest_charges()
    {
        $provider = new FakePaymentProvider();

        $provider->charge(new Currency(15,"USD"),"card-token");
        $provider->charge(new Currency(30,"USD"),"card-token");
        $provider->charge(new Currency(45,"USD"),"card-token");

        $charges = $provider->getRecentCharges();

        $this->assertCount(3,$charges);
    }



    public function test_can_perform_a_refund_based_on_charge()
    {
        $provider = new FakePaymentProvider();

        $result = $provider->refund("charge_id13yi371",new Currency(15,"USD"));

        $this->assertTrue($result);
    }

    public function test_provider_not_offer_refund_process()
    {
        $provider = new FakePaymentProvider();
        $provider->disableRefund();

        $this->expectException(PaymentProviderNoRefundException::class);
        $result = $provider->refund("charge_id13yi371",new Currency(15,"USD"));
    }
}
