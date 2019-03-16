<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;

/*use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;*/

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        Blade::if('isAdmin', function (){

            if (Auth::check()) {
                return Auth::user()->isAdmin===1 ?true:false;
                
            }



        });



        Blade::if('isWorker', function (){

            if (Auth::check()) {
                return Auth::user()->isAdmin===0 ?true:false;

            }



        });




    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
