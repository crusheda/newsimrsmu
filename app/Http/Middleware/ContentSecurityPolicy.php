<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $csp = implode(' ', [
            "default-src 'self';",

            // SCRIPT (Turnstile butuh ini)
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://challenges.cloudflare.com blob:;",

            // STYLE (Google Fonts)
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com;",

            // FONT (WAJIB untuk Google Fonts)
            "font-src 'self' https://fonts.gstatic.com data:;",

            // TURNSTILE
            "frame-src 'self' blob: https://challenges.cloudflare.com;",
            "connect-src 'self' https://challenges.cloudflare.com;",

            // IMAGE
            "img-src 'self' data: blob: https://*.simrsmu.com;",
        ]);

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
