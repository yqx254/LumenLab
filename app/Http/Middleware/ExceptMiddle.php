<?php


namespace App\Http\Middleware;

use Closure;

class ExceptMiddle{
    public function handle($request, Closure $next){
        echo 'Inside exception middleware';
        echo "<br />";
        return $next($request);
    }
}