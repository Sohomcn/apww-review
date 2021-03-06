<?php

namespace App\Http\Middleware;

use Closure;

class FanAuthentication
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
        if($request->user() && $request->user()->usertype == 3){
            return $next($request);
        }else if($request->user() == null){
            return redirect('/');
        }
        
        abort(403, 'Unauthorized action.');
    }
}
