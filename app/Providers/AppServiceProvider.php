<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App as TransactionFactory;
use App\cash_source\Transaction;
use App\cash_source\Cash;
use App\cash_source\CreditCard;
use App\cash_source\BankTransfer;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Transaction::class, function ($app) {

            if (request()->has('CreditCard')) {
                return TransactionFactory::make(CreditCard::class);
            } elseif (request()->has('BankTransfer')) {
                return TransactionFactory::make(BankTransfer::class);
            } else {
                return TransactionFactory::make(Cash::class);
            }

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
