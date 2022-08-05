<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
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
        Collection::macro("dot", function ($key, $default) {
            $value = Arr::get($this, $key, $default);
            return is_iterable($value) ? collect($value) :  $value;
        });
    }
}
