<?php

namespace App\Http\Middleware;

use Closure;

use App\Corporateuser;

class AuthCorporateUser
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
        
        $corporateuser = Corporateuser::where('corporate_id', $request->route('corporate')->id)->where('user_id', $request->user()->id)->count();

        if ($corporateuser == 0)
        {
            return redirect()->back();
        }

        return $next($request);
    }
}
