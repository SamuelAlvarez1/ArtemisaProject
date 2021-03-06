<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Sale;
use App\Models\Booking;
use Illuminate\Http\Request;

class validarRol
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
        if (auth()->check() && auth()->user()->idRol == 1)
            return $next($request);

        return redirect("/home");
    }
}
