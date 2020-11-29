<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubscriptionStore
{
    
    public function handle(Request $request, Closure $next)
    {
        $hasSubscriptions = auth()->user()->subscriptions()->active()->whereHas('servicio', function ($query) use ($request) {
            $query->where('slug',$request->route()->parameter('slug'));
        })->exists();

        if(!$hasSubscriptions)
        {
            return redirect()->route('dashboard')->with('message', 'No estas suscrito a este servicio.');
        }else{
            return $next($request);
        }
        
    }
}
