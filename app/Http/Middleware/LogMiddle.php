<?php


namespace App\Http\Middleware;

use Closure;

class LogMiddle{
    public function handle($request, Closure $next){
        echo 'Inside log middleware';
        echo "<br>";
        return $next($request);
    }
}