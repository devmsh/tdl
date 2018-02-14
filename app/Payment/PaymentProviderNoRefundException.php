<?php
/**
 * Created by PhpStorm.
 * User: Unit
 * Date: 2/7/2018
 * Time: 4:06 PM
 */

namespace App\Payment;


use App\User;

class PaymentProviderNoRefundException extends \Exception
{
    public function render($request)
    {

    }
}