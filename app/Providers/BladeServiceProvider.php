<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Recaptcha
         */
        Blade::directive('recaptcha', function () {
            return "
                <div class=\"row mb-3\">
                    <div class=\"g-recaptcha offset-md-4\" data-sitekey=\"{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}\"></div>
                </div>
            ";
        });
    }
}
