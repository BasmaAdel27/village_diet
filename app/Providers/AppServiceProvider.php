<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use function PHPUnit\Framework\isEmpty;

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
        // TODO: check on date of subscription , set date to finished , and reactivate the subscription
        try {
            $setting = Setting::first();
            View::share('setting', $setting);
        } catch (\Exception $e) {

            return false;
        }
    }
}
