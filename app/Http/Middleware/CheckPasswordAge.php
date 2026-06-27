<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckPasswordAge
{
    public function handle($request, Closure $next)
    {
        if(!auth()->check()){
            return $next($request);
        }

        // pengecualian
        if(
            $request->routeIs([
                'v4.password.expired',
                'v4.password.updatePassword',
                'v4.logout'
            ])
        ){
            return $next($request);
        }

        $user = auth()->user();
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
            return redirect()->route('v4.password.expired');
        }

        return $next($request);
    }
}
