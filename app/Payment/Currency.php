<?php
/**
 * Created by PhpStorm.
 * User: Unit
 * Date: 2/5/2018
 * Time: 5:21 PM
 */

namespace App\Payment;


class Currency
{

    public $amount;
    public $iso_code;

    public function __construct($amount, $iso_code)
    {
        $this->amount = $amount;
        $this->iso_code = $iso_code;
    }
}