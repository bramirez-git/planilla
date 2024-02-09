<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateNormal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('session') == "activa")
        {
            if($request->session()->get('two_factor_enabled') === true)
            {
                if($request->session()->get('two_factor_verified') === true)
                {

                }else{
                    return redirect()->route('two');
                }
            }
            else{
                return $next($request);
            }
        }

        return redirect()->route('inicio');
    }

}
