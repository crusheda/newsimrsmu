<?php

namespace App\Http\Controllers\Auth\v4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function index(Request $request, $token)
    {
        return view('pages.v4.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // public function reset(Request $request)
    // {
    //     $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed|min:8',
    //     ]);

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),

    //         function ($user, $password) {
    //             $user->password = $password;
    //             $user->save();
    //         },
    //     );

    //     return $status == Password::PASSWORD_RESET ? redirect('/login')->with('status', 'Password berhasil diubah') : back();
    // }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token'=>'required',
            'email'=>'required|email',
            'password'=>[
                'required',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[!@#$%^&*]/',
            ],
        ],[
            'password.required'=>'Password baru wajib diisi',
            'password.min'=>'Password minimal 8 karakter',
            'password.confirmed'=>'Konfirmasi password tidak cocok',
            'password.regex'=>'Password harus memiliki huruf kapital, angka, dan karakter khusus',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validator->errors()->first()
            ],422);
        }

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function($user,$password){
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if($status !== Password::PASSWORD_RESET){
            return response()->json([
                'status'=>false,
                'message'=>__($status)
            ],400);
        }

        return response()->json([
            'status'=>true,
            'message'=>'Password berhasil diperbarui. Silakan login kembali.'
        ]);
    }
}
