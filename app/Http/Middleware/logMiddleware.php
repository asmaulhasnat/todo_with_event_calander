<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Auth;
use App\ActivityLogs; 
class logMiddleware
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
        

        $log = [];
        $log['method'] = Request::method();
        $log['url'] = Request::fullurl();
        $log['agent'] = Request::header('user-agent');
        $log['ip'] = Request::ip();
        $log['name'] = Auth::user()->name ?? 'Guest usser';
        ActivityLogs::create($log);
  
        return $next($request);
    }
}
