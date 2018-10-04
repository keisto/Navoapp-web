<?php

namespace App\Http\Middleware\Subscription;

use Closure;

class RedirectIfNotActive
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
        if (!auth()->check() || auth()->user()->doesNotHaveSubscription()) {
            return redirect()->route('plans.index')->with('warning', 'Subscription not active. You\'ll need a plan to search');

        }
        return $next($request);
    }
}
