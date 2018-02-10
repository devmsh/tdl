<?php

namespace Tests\Unit;

use App\Payment\Currency;
use App\Payment\FakePaymentProvider;
use App\Payment\PaymentProviderInterface;
use App\Payment\PaymentProviderNoRefundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FakePaymentProviderTest extends TestCase
{
    public function test_is_implement_the_payment_provider_interface()
    {
        $provider = new FakePaymentProvider();

        $interfaces = class_implements($provider);

        $this->assertArrayHasKey(PaymentProviderInterface::class,$interfaces);
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

    public function test_can_perform_a_charge_based_on_credit_card_token()
    {
        $provider = new FakePaymentProvider();

        $provider->charge(new Currency(15,"USD"),"card-token");

        $charge = $provider->getRecentCharges()[0];

        /** @var Currency $currency */
        $currency = $charge['currency'];
        $this->assertEquals(15, $currency->amount);
        $this->assertEquals("USD", $currency->iso_code);
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
