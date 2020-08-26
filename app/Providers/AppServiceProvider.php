<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

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

    public function boot(){
        DB::listen(function ($query){
            echo '<br>';
            echo $query->sql;
            echo '<br>';
            echo $query->time;
            echo '<br>';
        });
    }

}
