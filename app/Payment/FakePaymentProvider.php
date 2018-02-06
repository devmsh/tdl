<?php
/**
 * Created by PhpStorm.
 * User: Unit
 * Date: 2/5/2018
 * Time: 5:01 PM
 */

namespace App\Payment;


class FakePaymentProvider implements PaymentProviderInterface
{
    var $charges = [];

    public function charge(Currency $currency, $source, $notes = null, $additional_data = [])
    {
        $this->charges[] = [
            'currency' => $currency,
            'source' => $source,
            'notes' => $notes,
            'additional_data' => $additional_data,

        ];
        return [
            'status' => "success",
            'amount' => $currency->amount,
            'currency' => $currency->iso_code,
        ];
    }

    public function refund($charge_id, Currency $currency, $notes = null, $additional_data = [])
    {
        return true;
    }

    public function getRecentCharges()
    {
        return $this->charges;
    }
}