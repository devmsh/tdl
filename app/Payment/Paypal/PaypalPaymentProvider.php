<?php

namespace App\Payment\Paypal;

use App\Payment\Currency;
use App\Payment\PaymentProviderInterface;

class PaypalPaymentProvider implements PaymentProviderInterface {

    public function charge(Currency $currency, $source =null, $notes=null, $additional_data=null)
    {
        // TODO: Implement charge() method.
    }

    public function refund($charge_id, Currency $currency, $notes, $additional_data)
    {
        // TODO: Implement refund() method.
    }

    public function getRecentCharges()
    {
        // TODO: Implement getRecentCharges() method.
    }

    public function handelResponse($status, $currency, $message, $charge_id, $success_callback, $failed_callback)
    {
        if($status == "success"){
            $success_callback($charge_id,$currency);
        }else{
            $failed_callback($message);
        }
    }
}