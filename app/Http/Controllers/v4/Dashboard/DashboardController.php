<?php

namespace App\Http\Controllers\v4\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    function index()
    {
        $expired = false;
        $passwordAge = 0;
        $passwordAgeText = '∞';

        if (auth()->check() && auth()->user()->last_update_password) {
            $passwordAge = Carbon::parse(auth()->user()->last_update_password)->diffInDays(now());
            $passwordAgeText = ceil(
                Carbon::parse(auth()->user()->last_update_password)
                    ->diffInHours(now()) / 24
            );

            if ($passwordAge >= 80) {
                $expired = true;
            }
        }

        // print_r(Carbon::parse(auth()->user()->last_update_password)->diffInDays(now()));
        // die();

        // if(!$user->last_update_password){
        //     $expired = true;
        // }else{
        //     $expired =
        //         Carbon::parse(
        //             $user->last_update_password
        //         )
        //         ->addDays(90)
        //         ->isPast();
        // }

        $data = [
            'expired' => $expired,
            'expiredDate' => $passwordAgeText,
        ];

        return view('pages.v4.dashboard.index')->with('list', $data);
    }
}
