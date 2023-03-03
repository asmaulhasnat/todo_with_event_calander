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


        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 3600);

       $curl='app/helpers/util.php';
        require base_path($curl);
    }
}
