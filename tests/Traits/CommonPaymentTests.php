<?php
/**
 * Created by PhpStorm.
 * User: Unit
 * Date: 2/10/2018
 * Time: 4:00 PM
 */

namespace Tests\Traits;


use App\Payment\Currency;
use App\Payment\PaymentProviderInterface;

trait CommonPaymentTests
{
    public function test_is_implement_the_payment_provider_interface()
    {
        $provider = $this->getProvider();

        $interfaces = class_implements($provider);

        $this->assertArrayHasKey(PaymentProviderInterface::class,$interfaces);
    }

    public function test_can_request_a_charge_from_the_user()
    {
        $provider = $this->getProvider();

        $provider->charge(new Currency(15,"USD"),"card-token");

        $this->assertTrue(true);
    }

    public function test_can_handel_the_success_payment_gateway_response()
    {
        $provider = $this->getProvider();

        $provider->handelResponse(
            "success",
            new Currency(15,"USD"),
            null,
            "p-123asdbjh",
            function($charge_id,Currency $currency){
                $this->assertEquals("p-123asdbjh",$charge_id);
                $this->assertEquals(15,$currency->amount);
                $this->assertEquals("USD",$currency->iso_code);
            },
            function($message){
                $this->fail('the failed callback triggered during a success charge');
            });
    }

    public function test_can_handel_the_failed_payment_gateway_response()
    {
        $provider = $this->getProvider();

        $provider->handelResponse(
            "failed",
            null,
            "customer have no enough money",
            null,
            function($charge_id,Currency $currency){
                $this->fail('the success callback triggered during a failed charge');
            },
            function($message){
                $this->assertEquals("customer have no enough money",$message);
            });
    }
}