<?php

namespace App\Http\Middleware;

use Closure;

class CheckCorporate
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
        # Checks to see if the corporate account is active
        
        if ($request->route('corporate')->active == false) {
            return redirect()->back();
        }

        return $next($request);
    }
}
