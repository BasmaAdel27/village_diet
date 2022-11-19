<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\StaticPage\StaticPage;
use App\Models\Subscription;
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
        if (auth()->check() && auth()->user()->currentSubscription?->end_date <= now()->endOfDay()) {
            auth()->user()->currentSubscription()->update(['status' => Subscription::FINISHED]);
        }

        try {
            $setting = Setting::first();
            View::share('setting', $setting);

            $staticPages = StaticPage::WhereNotIn('slug', [
                'About-Village-Diet',
                'Our-Vision',
                'Food-Recipes'
            ])
                ->where('is_active', true)
                ->where('is_show_in_app', false)
                ->listsTranslations('title')
                ->select('static_pages.id')->get();

            View::share('staticPages', $staticPages);
        } catch (\Throwable $th) {
            return false;
        }
    }
}
