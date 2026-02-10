<?php

namespace App\Http\Controllers\v4\Akun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AksesJabatanController extends Controller
{
    function index()
    {
        return view('pages.v4.akun.aksesjabatan.index');
    }
}
