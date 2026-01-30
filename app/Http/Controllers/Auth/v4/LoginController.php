<?php

namespace App\Http\Controllers\Auth\v4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    function index()
    {
        if (Auth::check()) {
            return redirect()->route('v4.dashboard');
        } else {
            return view('pages.v4.auth.login');
        }
    }
}
