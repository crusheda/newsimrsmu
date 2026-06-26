<?php

namespace App\Http\Controllers\Auth\v4;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use \Carbon\Carbon;
use Auth;

class PasswordController extends Controller
{
    public function expired()
    {
        // if(!session('password_expired')){
        //     return redirect()->route('v4.dashboard');
        // }

        if(!Auth::check()){
            return redirect()->route('v4.login');
        }

        $user = User::find(Auth::user()->id);

        $expired = false;

        if(!$user->last_update_password){
            $expired = true;
        }else{
            $expired =
                Carbon::parse(
                    $user->last_update_password
                )
                ->addDays(90)
                ->isPast();
        }

        if($expired){
            return view(
                'pages.v4.auth.password-expired',
                compact('user')
            );
        }

        return redirect()->route('v4.dashboard');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password'=>[
                'required',
                'confirmed',
                'min:8'
            ]
        ]);

        $user=auth()->user();

        // cek password baru sama dengan password lama
        if(
            Hash::check(
                $request->password,
                $user->password
            )
        ){
            return response()->json([
                'message'=>'Password baru tidak boleh sama dengan password sebelumnya'
            ],422);
        }

        $user->update([
            'password'=>Hash::make(
                $request->password
            ),
            'last_update_password'=>now()
        ]);

        session()->forget('password_expired');

        return response()->json([
            'message'=>'Password berhasil diperbarui'
        ]);
    }
}
