<?php

namespace App\Http\Controllers\v4\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        return view('pages.v4.dashboard.index');
    }
}
