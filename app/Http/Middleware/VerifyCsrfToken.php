<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/*', // Exclude all API routes
        '/webhook/stripe', // Exclude a specific webhook route
        '/external-callback', // Exclude a specific third-party callback route
    ];
    
}
