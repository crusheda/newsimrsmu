<?php

namespace App\Http\Controllers\v4\IT\Perbaikan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\perbaikan_it;
use App\Models\perbaikan_it_kategori;
use App\Models\perbaikan_it_lampiran;
use App\Services\TelegramService;
use Carbon\Carbon;
use Auth, Redirect;

class TiketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kategori = perbaikan_it_kategori::where('status', 1)->get();

        if ($user->can('tiket_it') || $user->hasRole('karu-it')) {
            return view('pages.v4.it.pengajuan.perbaikan.index', compact('kategori'));
        } else {
            return redirect()->back();
        }
        // abort(403);
    }

    function table()
    {
        // hitung total tiket per status bulan ini dan bulan lalu, lalu hitung persentasenya
        $now = now();
        $startThisMonth = $now->copy()->startOfMonth();
        $startLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endLastMonth = $now->copy()->subMonth()->endOfMonth();

        $summary = [];

        /*
        |--------------------------------------------------------------------------
        | DITERIMA
        |--------------------------------------------------------------------------
        */
        $thisMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_terima')
            ->whereNull('tgl_kerjakan')
            ->whereNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startThisMonth, $now])
            ->count();

        $lastMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_terima')
            ->whereNull('tgl_kerjakan')
            ->whereNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->count();

        $summary['diterima'] = $this->calculatePercent($thisMonth, $lastMonth);


        /*
        |--------------------------------------------------------------------------
        | DIKERJAKAN
        |--------------------------------------------------------------------------
        */
        $thisMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_kerjakan')
            ->whereNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startThisMonth, $now])
            ->count();

        $lastMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_kerjakan')
            ->whereNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->count();

        $summary['dikerjakan'] = $this->calculatePercent($thisMonth, $lastMonth);


        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */
        $thisMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startThisMonth, $now])
            ->count();

        $lastMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->count();

        $summary['selesai'] = $this->calculatePercent($thisMonth, $lastMonth);


        /*
        |--------------------------------------------------------------------------
        | DITOLAK
        |--------------------------------------------------------------------------
        */
        $thisMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_tolak')
            ->whereBetween('created_at', [$startThisMonth, $now])
            ->count();

        $lastMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_tolak')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->count();

        $summary['ditolak'] = $this->calculatePercent($thisMonth, $lastMonth);

        // ambil data tiket perbaikan IT dengan relasi user dan kategori, urutkan berdasarkan updated_at desc
        $show = perbaikan_it::with('kategori')
                            ->leftJoin('users', 'perbaikan_it.pegawai_id', '=', 'users.id')
                            // ->leftJoin('perbaikan_it_kategori', function($join) {
                            //     $join->on('perbaikan_it.kategori_id', '=', 'perbaikan_it_kategori.id')
                            //         ->whereNull('perbaikan_it_kategori.deleted_at')
                            //         ->where('perbaikan_it_kategori.status', 1);
                            // })
                            ->select(
                                'perbaikan_it.*',
                                'users.nama as nama_user',
                                'users.nama_lengkap as nama_lengkap_user',
                                // 'perbaikan_it_kategori.deskripsi as nama_kategori'
                            )
                            ->whereNull('perbaikan_it.deleted_at')
                            ->orderBy('perbaikan_it.updated_at', 'desc')
                            ->get();

        $allUnits = $show->pluck('unit')
        ->flatten()
        ->unique()
        ->values();

        $roles = Role::whereIn('name', $allUnits)
        ->pluck('deskripsi', 'name');

        // if ($show->isEmpty()) {
        //     return response()->json(['message' => 'Data Tiket Perbaikan IT tidak ditemukan'], 404);
        // }

        $data = [
            'summary' => $summary,
            'roles' => $roles,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    public function hapus($id)
    {
        DB::beginTransaction();

        try {

            $tiket = perbaikan_it::findOrFail($id);
            $pinjam->delete(); // soft delete perbaikan_it

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // fungsi untuk menghitung persentase perubahan dari bulan lalu ke bulan ini
    private function calculatePercent($thisMonth, $lastMonth)
    {
        if ($lastMonth > 0) {
            $percent = (($thisMonth - $lastMonth) / $lastMonth) * 100;
        } else {
            $percent = $thisMonth > 0 ? 100 : 0;
        }

        return [
            'total' => $thisMonth,
            'percent' => round($percent, 2),
            'is_up' => $percent >= 0
        ];
    }
}
