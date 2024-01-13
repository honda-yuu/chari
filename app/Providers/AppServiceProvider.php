<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        
         \URL::forceScheme('https');
         $this->app['request']->server->set('HTTPS','on');
         
         //if(request()->is('admin/*')){
            // config(['session.cookie' => config('session.cookie_admin')]);
         //}
    }
    
}
