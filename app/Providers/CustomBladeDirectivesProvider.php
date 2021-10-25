<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class CustomBladeDirectivesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Custom blade directives
         */
        Blade::directive('required', function($expression){
            return '<required class="text-danger">*</required>';
        });
        Blade::directive('requiredInfo', function($expression){
            return '<div class="form-group m-form__group row "><div class="col-lg-12"><label>'.__('layout.required_info_text').'</label></div></div>';
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
