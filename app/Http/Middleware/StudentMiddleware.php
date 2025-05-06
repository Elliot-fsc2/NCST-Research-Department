<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isStudent()) {
            return redirect('/');
        }

        return $next($request);
    }
}