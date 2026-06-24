<?php

namespace App\Http\Controllers\Auth\v4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function index(Request $request, $token)
    {
        return view('pages.v4.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),

            function ($user, $password) {
                $user->password = $password;
                $user->save();
            },
        );

        return $status == Password::PASSWORD_RESET ? redirect('/login')->with('status', 'Password berhasil diubah') : back();
    }
}
