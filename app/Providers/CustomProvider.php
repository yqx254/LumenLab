<?php


namespace App\Providers;


use App\Services\Custom1;
use Carbon\Laravel\ServiceProvider;

class CustomProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Services\CustomService', function(){
            return new Custom1();
        });
    }
}