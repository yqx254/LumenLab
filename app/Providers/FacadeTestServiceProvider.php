<?php


namespace App\Providers;


use App\Services\FacadeService;
use Illuminate\Support\ServiceProvider;

class FacadeTestServiceProvider extends ServiceProvider{
    public function register(){
        $this->app->singleton('myFacade',function(){
            return new FacadeService();
        });
    }
}