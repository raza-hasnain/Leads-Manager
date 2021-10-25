<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Session;

class LangServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $lang = 'en';

        $js_lang = '<script type="text/javascript"> Lang.setLocale(\''.$lang.'\'); </script>';
        View::share('js_lang', $js_lang);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
