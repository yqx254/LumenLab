<?php


namespace App\Http\Middleware;


class AfterMiddle{
    public function handle($request, \Closure $next){
        $response = $next($request);
        //所谓的后置中间件
        // perform actions
        return $response;
    }
}