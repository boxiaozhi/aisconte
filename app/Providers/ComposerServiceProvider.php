<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['frontend.home.*', 'frontend.note.*', 'frontend.navi.*', 'frontend.timeline.*'], function($view) {
            $nameStrArr = explode('.', $view->name());
            if(count($nameStrArr) >= 2){
                $title = config('frontendbase.'.$nameStrArr[1]) ?: config('app.name');
            } else {
                $title = config('app.name');
            }
            $view->with('pageTitle', $title);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}