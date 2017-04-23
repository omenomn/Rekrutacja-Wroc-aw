<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Validator::replacer('exists', function ($message, $attribute, $rule, $parameters) {

          return str_replace(':value', request()->input($attribute), $message);
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {  
      //
    }
}
