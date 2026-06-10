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
use App\Models\epinjam_asal;
use App\Models\epinjam_kategori;
use Carbon\Carbon;
use Auth, Redirect;

class EPinjamKategoriController extends Controller
{
    function index()
    {
        $user = Auth::user();

        if ($user->can('epinjam_admin')) {
            return view('pages.v4.it.epinjam.ref.kategori');
        } else {
            return redirect()->back();
        }
    }
}
