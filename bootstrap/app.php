<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Middleware\ContentSecurityPolicy;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            EnsureFrontendRequestsAreStateful::class,
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\HeaderDataMiddleware::class,
        ]);
        // $middleware->redirectGuestsTo(fn () => route('v4.login'));
        $middleware->append(ContentSecurityPolicy::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // ✅ HANDLE THROTTLE (429)
        // $exceptions->render(function (
        //     TooManyRequestsHttpException $e,
        //     Request $request
        // ) {
        //     if (! $request->expectsJson()) {

        //         $retryAfter = $e->getHeaders()['Retry-After'] ?? 60;

        //         return back()
        //             ->withErrors([
        //                 'throttle' => "Terlalu banyak percobaan login. Coba lagi dalam {$retryAfter} detik."
        //             ])
        //             ->withInput($request->except('password'));
        //     }
        // });

        // ✅ 404 NOT FOUND
        $exceptions->render(function (
            NotFoundHttpException $e,
            Request $request
        ) {
            if (! $request->expectsJson()) {
                return response()->view('pages.v4.auth.error.404', [], 404);
            }

            return response()->json([
                'message' => 'Halaman tidak ditemukan'
            ], 404);
        });

        // ✅ AUTH REDIRECT
        $exceptions->render(function (
            AuthenticationException $e,
            Request $request
        ) {
            if (! $request->expectsJson()) {
                return redirect()->route('v4.login');
            }
        });
    })
    ->create();
