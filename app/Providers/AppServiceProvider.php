<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Observers\OrderlineObserver;
use App\Models\Orderline;
use App\Models\Order;
use App\Observers\OrderObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Orderline::observe(OrderlineObserver::class);
        Order::observe(OrderObserver::class);
        Validator::extend('not_before_today', function ($attribute, $value, $parameters, $validator) {
            return strtotime($value) >= strtotime('today');
        });
    }
}
