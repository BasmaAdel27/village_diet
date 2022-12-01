<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class InActiveStatus
{

    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->currentSubscription?->status == 'in_active') {
            auth()->user()->tokens()->delete();
            return failedResponse(Lang::get('subscription_is_in_active'), 401);
        }

        return $next($request);
    }
}
