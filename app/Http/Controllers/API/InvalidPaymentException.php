<?php
/**
 * Created by PhpStorm.
 * User: Unit
 * Date: 2/3/2018
 * Time: 4:25 PM
 */

namespace App\Http\Controllers\API;


class InvalidPaymentException extends \Exception
{

    /**
     * InvalidPaymentException constructor.
     */
    public function __construct()
    {
    }


}