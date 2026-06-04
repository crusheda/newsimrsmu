<?php

namespace App\Http\Controllers\v4\IT\EPinjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\epinjam;
use App\Models\epinjam_list;
use App\Models\epinjam_barang;
use App\Models\epinjam_kategori;
use Carbon\Carbon;
use Auth, Redirect;

class EPinjamController extends Controller
{
    function index()
    {
        return view('pages.v4.it.epinjam.index');
    }
}
