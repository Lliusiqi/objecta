<?php

namespace App\Http\Middleware;

use Closure;

class stu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        echo "bbb";
//        return $next($request);
        $response = $next($request);
//        echo 'majiao';
        return $response;
    }
}
