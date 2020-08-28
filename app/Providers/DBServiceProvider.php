<?php


namespace App\Providers;


use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\DB;

class DBServiceProvider extends ServiceProvider{

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