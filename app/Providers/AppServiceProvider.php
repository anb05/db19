<?php

namespace Db19\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Schema::defaultStringLength(191);

//        \DB::listen(function ($query) {
//            echo "<h1> QUERY </h1>";
//            echo "<h2> SQL </h2>";
//            dump($query->sql);
//
//            echo "<h2> BINDING </h2>";
//            dump($query->bindings);
//        });
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
