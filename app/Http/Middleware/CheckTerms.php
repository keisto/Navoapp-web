<?php

namespace App\Http\Middleware;

use Closure;

class CheckTerms
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
        if (auth()->user()->terms) {
            return redirect()->route('account.index')
                ->with('warning', 'You must agree to our terms and privacy policy before using our application.');
        }
        return $next($request);
    }
}
