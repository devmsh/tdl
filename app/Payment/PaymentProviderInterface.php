<?php
/**
 * Created by PhpStorm.
 * User: Unit
 * Date: 2/5/2018
 * Time: 5:01 PM
 */

namespace App\Payment;


interface PaymentProviderInterface
{
    public function charge(Currency $currency,$source,$notes,$additional_data);

    public function refund($charge_id,Currency $currency,$notes,$additional_data);

    public function getRecentCharges();

}