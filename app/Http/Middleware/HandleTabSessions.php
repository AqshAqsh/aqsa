<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleTabSessions
{
    public function handle($request, Closure $next)
    {
        // Check if a unique session for the tab already exists, otherwise create one
        if (!session()->has('tab_id')) {
            // Generate a unique session ID for each tab
            session(['tab_id' => uniqid('tab_', true)]);
        }

        return $next($request);
    }
}
