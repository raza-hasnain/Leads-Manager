<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Routing\Route;
use JavaScript;
use View;
use Config;
use App\companySetting;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
        public function boot()
            {
                Schema::defaultStringLength(191);
               
                if(env('APP_VERFY') == 'success' && env('APP_INSTALL') == 'success' ){
                $company = companySetting::first();
                View::share('company',$company);
            }
              View::share('pusher_key',Config::get('broadcasting.connections.pusher.key'));
                View::share('version', Config::get('app.version'));
            }
}