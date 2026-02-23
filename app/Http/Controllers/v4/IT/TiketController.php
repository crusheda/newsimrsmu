<?php

namespace App\Http\Controllers\v4\IT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\perbaikan_it_kategori;
use App\Models\perbaikan_it_lampiran;
use App\Models\perbaikan_it;
use Carbon\Carbon;
use Auth, Redirect;

class TiketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kategori = perbaikan_it_kategori::where('status', 1)->get();

        if ($user->can('tiket-perbaikan-it') || $user->hasRole('karu-it')) {
            return view('pages.v4.it.pengajuan.perbaikan.index', compact('kategori'));
        }

        abort(403);
    }

    function table()
    {
        $show = perbaikan_it::leftJoin('users', 'perbaikan_it.pegawai_id', '=', 'users.id')
                            ->leftJoin('perbaikan_it_kategori', function($join) {
                                $join->on('perbaikan_it.kategori_id', '=', 'perbaikan_it_kategori.id')
                                    ->whereNull('perbaikan_it_kategori.deleted_at')
                                    ->where('perbaikan_it_kategori.status', 1);
                            })
                            ->select(
                                'perbaikan_it.*',
                                'users.nama as nama_user',
                                'users.nama_lengkap as nama_lengkap_user',
                                'perbaikan_it_kategori.deskripsi as nama_kategori'
                            )
                            ->whereNull('perbaikan_it.deleted_at')
                            ->orderBy('perbaikan_it.updated_at', 'desc')
                            ->get();

        if ($show->isEmpty()) {
            return response()->json(['message' => 'Data Tiket Perbaikan IT tidak ditemukan'], 404);
        }

        return response()->json($show, 200);
    }
}
