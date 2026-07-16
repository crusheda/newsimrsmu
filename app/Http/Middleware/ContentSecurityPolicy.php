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

            // SCRIPT
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://challenges.cloudflare.com https://meet.jit.si blob:;",

            // STYLE
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://meet.jit.si;",

            // FONT
            "font-src 'self' https://fonts.gstatic.com https://meet.jit.si data:;",

            // FRAME (Jitsi memakai iframe)
            "frame-src 'self' blob: https://challenges.cloudflare.com https://meet.jit.si;",

            // WEBSOCKET + API CONNECTION JITSI
            "connect-src 'self' https://challenges.cloudflare.com https://meet.jit.si wss://meet.jit.si;",

            // MEDIA (kamera dan microphone)
            "media-src 'self' blob:;",

            // IMAGE
            "img-src 'self' data: blob: https://*.simrsmu.com https://meet.jit.si;",

        ]);

        $response->headers->set(
            'Content-Security-Policy',
            $csp
        );

        return $response;
    }
}
