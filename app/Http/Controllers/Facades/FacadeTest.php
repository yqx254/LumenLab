<?php


namespace App\Http\Controllers\Facades;


use Illuminate\Support\Facades\Facade;

class FacadeTest extends Facade{
    protected static function getFacadeAccessor()
    {
        return 'myFacade';
    }
}