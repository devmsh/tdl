<?php

namespace App\Http\Controllers;

use App\Payment\Currency;
use App\Payment\PaymentProviderInterface;
use App\Payment\PaymentProviderNoRefundException;
use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function welcome(Request $request, PaymentProviderInterface $provider)
    {
        var $ch = $provider->charge();

        $provider->handelResponse($ch->status_code,new Currency($ch->price));
    }
}
