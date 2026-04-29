<?php

namespace App\Http\Controllers\Auth\v4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $request->validate([
        //     'name'     => 'required|string',
        //     'password' => 'required|string',
        //     'captcha'  => 'required|captcha',
        // ], [
        //     'captcha.captcha' => 'Captcha salah',
        // ]);

        $request->validate([
            'name'     => 'required|string',
            'password' => 'required|string',
            'cf-turnstile-response' => 'required'
        ], [
            'cf-turnstile-response.required' => 'Silakan verifikasi captcha',
        ]);

        $key = Str::lower($request->input('name')).'|'.$request->ip();

        // VERIFY THROTTLE
        if (RateLimiter::tooManyAttempts($key, 10)) {
            $seconds = RateLimiter::availableIn($key);

            return redirect()
                ->route('v4.login')
                ->withErrors([
                    'throttle' => "Terlalu banyak percobaan login."
                ])
                ->with('lockout', $seconds);
        }

        // VERIFY TURNSTILE
        $response = Http::asForm()->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret' => config('services.turnstile.secret_key'),
                'response' => $request->input('cf-turnstile-response'),
                'remoteip' => $request->ip(),
            ]
        );

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            return redirect()
                ->route('v4.login')
                ->withErrors(['cf-turnstile-response' => 'Captcha tidak valid'])
                ->withInput($request->except('password'));
        }

        // LOGIN
        $credentials = $request->only('name', 'password');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($key, 300); // 5 menit

            $remaining = RateLimiter::remaining($key, 10);

            if ($remaining <= 0) {
                $seconds = RateLimiter::availableIn($key);

                return redirect()
                    ->route('v4.login')
                    ->withErrors([
                        'throttle' => "Terlalu banyak percobaan login."
                    ])
                    ->with('lockout', $seconds);
            }

            return redirect()
                ->route('v4.login')
                ->withErrors([
                    'name' => "Username atau password salah. Sisa percobaan: {$remaining}x"
                ])
                ->withInput($request->except('password'));
        }

        $request->session()->regenerate();
        RateLimiter::clear($key);
        return redirect()->intended(route('v4.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('v4.login');
    }
}
