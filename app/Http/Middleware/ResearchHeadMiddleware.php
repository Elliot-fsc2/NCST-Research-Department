<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResearchHeadMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isResearchHead()) {
            return redirect('/');
        }

        return $next($request);
    }
}