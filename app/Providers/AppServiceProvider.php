<?php

namespace App\Providers;

use App\Payment\FakePaymentProvider;
use App\Payment\PaymentProviderInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        app()->bind(PaymentProviderInterface::class,function(){
            $fakePaymentProvider = new FakePaymentProvider();

            $refund = request()->get('refund');
            if($refund == "false"){
                $fakePaymentProvider->disableRefund();
            }
            return $fakePaymentProvider;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
