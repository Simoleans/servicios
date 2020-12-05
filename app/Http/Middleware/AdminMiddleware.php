<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(!auth()->user()->admin())
        {
            return redirect()->route('dashboard')->with('message', 'No tienes permisos para entrar a esté sitio.');

        }else{
            return $next($request);
        }
    }
}
