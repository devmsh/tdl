<?php

namespace App\Http\Controllers;

use App\Payment\Currency;
use App\Payment\PaymentProviderInterface;
use App\Payment\PaymentProviderNoRefundException;
use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function welcome(Request $request)
    {
        $user = Auth::user();
        User::getNull();
        // ????

        //$provider->refund("charge_id13yi371",new Currency(15,"USD"));
    }
}
