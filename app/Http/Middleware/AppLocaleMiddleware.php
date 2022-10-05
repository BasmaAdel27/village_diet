<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (request()->header('Accept-Language')) {
            app()->setLocale(request()->header('Accept-Language'));
        } else {
            app()->setlocale(config('app.locale'));
        }

        return $next($request);
    }
}
