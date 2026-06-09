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

class EPinjamController extends Controller
{
    function index()
    {
        $user = Auth::user();

        if ($user->can('epinjam') || $user->hasRole('karu-it')) {
            return view('pages.v4.it.epinjam.index');
        } else {
            return redirect()->back();
        }
    }

    function loadTambah()
    {
        $barang = epinjam_kategori::with('barang')->get();
        $users = User::select('id', 'nama_lengkap', 'nama', 'name')
                        ->with([
                            'roles:id,name'
                        ])
                        ->whereNotNull('nik')
                        ->whereNull('deleted_at')
                        ->where(function ($q) {
                            $q->where('status', '!=', 99)
                            ->orWhereNull('status');
                        })
                        ->orderBy('nama', 'ASC')
                        ->get();

        $data = [
            'barang' => $barang,
            'users' => $users,
        ];

        return response()->json($data, 200);
    }

    function refresh()
    {
        $show = epinjam::with([
            'userPinjam:id,nama,name',
            'userPinjam.roles:id,name',
            'userAdminPinjam:id,nama',
            'userKembali:id,nama',
            'userAdminKembali:id,nama',

            'list:id,id_epinjam,id_barang,jumlah,tgl_rencana_kembali,peruntukan,status',
            'list.barang:id,id_kategori,id_asal,nama,kondisi,kelengkapan',
            'list.barang.kategori:id,nama',
            'list.barang.asal:id,unit'
        ])
        ->where('status', 1)
        ->orderByDesc('id')
        ->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'user_id' => 'required|integer|exists:users,id',
            'tgl_pinjam' => 'required|date',
            'keperluan' => 'nullable|string',

            'detail' => 'required|array|min:1',

            'detail.*.barang_id' => 'required|integer|exists:epinjam_barang,id',
            'detail.*.peruntukan' => 'nullable|string',
            'detail.*.tgl_kembali' => 'nullable|date',

        ],[
            'user_id.required' => 'Pegawai peminjam belum dipilih.',
            'detail.required' => 'Barang yang dipinjam belum dipilih.',
            'detail.*.barang_id.required' => 'Masih ada barang yang belum dipilih.',
            'detail.min' => 'Minimal 1 barang harus dipilih.'
        ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => $validator->errors()->toArray()
        //     ], 422);
        // }

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $pinjam = epinjam::create([
                'user_pinjam'       => $request->user_id,
                'user_admin_pinjam' => auth()->id(),
                'tgl_pinjam'        => $request->tgl_pinjam,
                'keperluan'         => $request->keperluan,
                'status'            => 1,
            ]);

            $detail = [];

            foreach ($request->detail as $item) {

                $detail[] = [
                    'id_barang'            => $item['barang_id'],
                    'jumlah'               => 1,
                    'tgl_rencana_kembali'  => $item['tgl_kembali'] ?: null,
                    'peruntukan'           => $item['peruntukan'],
                    'created_at'           => now(),
                    'updated_at'           => now(),
                ];

            }

            $pinjam->list()->createMany($detail);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan peminjaman berhasil disimpan.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }
    }
}
