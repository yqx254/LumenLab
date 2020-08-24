<?php


namespace App\Http\Middleware;

use Closure;

class Middle{
    public function __construct(){

    }

    public function handle($request, Closure $next){
        echo 'inside middleware';
        echo "<br>";
        if(!empty($request->get('data'))){
            echo json_encode($request->get('data'));
            echo "<br>";
        }
        return $next($request);
    }
}