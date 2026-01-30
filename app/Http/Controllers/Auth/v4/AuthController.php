<?php

namespace App\Http\Controllers\Auth\v4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'password' => 'required|string',
            'captcha'  => 'required|captcha',
        ], [
            'captcha.captcha' => 'Captcha salah',
        ]);

        $credentials = $request->only('name', 'password');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['name' => 'Username atau password salah'])
                ->withInput($request->except('password'));
        }

        // regenerate session (security best practice)
        $request->session()->regenerate();

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
