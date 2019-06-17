<?php

namespace App\Http\Middleware;

use Closure;

class goods
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
        $time=date('Y-m-d',time());
        // dd($time); 2019-06-17
        $start=strtotime($time.'06:00'.':00');
        // dd($start); 1560722400
        $end=strtotime($time.'17:00'.':00');
        // dd($end);
        if(!(time()>$start&&time()<$end)){
            echo "<script>alert('不在修改范围之内');window.history.back(-1);</script>";
        }
//        echo 'aaa';
        return $next($request);
//        return $next($request);
    }
}
