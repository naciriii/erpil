<?php

namespace App\Http\Middleware;

use Closure;

class HasToken
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
        if(!$request->hasHeader('token')) {
           return response('Magento Auth token.', 401);
        }
        return $next($request);
    }
}
