<?php

namespace App\Providers;

use Carbon\Carbon;
use Xendit\Xendit;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        Schema::defaultStringLength(128);
        date_default_timezone_set('Asia/Jakarta');
        config(['app.locale' => 'id']);
        Paginator::useBootstrap();
        // Xendit::setApiKey('xnd_production_H9vYVjHQg6nzYYCtY47tU3SAvoayRoTKQw5NnKNnXk0h2hzQXcaqL66Sd8D8y');
        Xendit::setApiKey('xnd_development_YgsZZQ4o5XoZBBgF0EROorc0Lodit00TIZflitcCaeiWzwcGaYs1bCjJkEQeJ9');

        Relation::morphMap([
            'customers' => 'App\Models\Customer',
            'users'     => 'App\Models\User'
        ]);
    }
}
