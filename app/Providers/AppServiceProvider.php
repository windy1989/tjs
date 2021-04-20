<?php

namespace App\Providers;

use Carbon\Carbon;
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
        Carbon::setLocale('id');

        Relation::morphMap([
            'customers' => 'App\Models\Customer'
        ]);
    }
}
