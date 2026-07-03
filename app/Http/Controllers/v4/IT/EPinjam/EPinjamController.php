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
        $barang = epinjam_kategori::with([
            'barang' => function ($q) {

                $q->where('status', 1)
                ->whereNull('deleted_at')
                ->whereNotExists(function ($sub) {

                        $sub->select(DB::raw(1))
                            ->from('epinjam_list')
                            ->whereColumn(
                                'epinjam_list.id_barang',
                                'epinjam_barang.id'
                            )
                            ->where('epinjam_list.status', 1)
                            ->whereNull('epinjam_list.deleted_at');

                });

            }
        ])->get();


        $barang = $barang->filter(function($kategori){
            return $kategori->barang->count() > 0;
        })->values();

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
            'userPinjam.roles:id,name,deskripsi',
            'userAdminPinjam:id,nama',
            'userKembali:id,nama',
            'userAdminKembali:id,nama',

            'list:id,id_epinjam,id_barang,jumlah,tgl_rencana_kembali,peruntukan,status',
            'list.barang:id,id_kategori,id_asal,nama,kondisi,kelengkapan',
            'list.barang.kategori:id,nama',
            'list.barang.asal:id,unit'
        ])
        ->whereIn('status', ['0','1'])
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

            'peminjam_type' => 'required|in:user,manual',

            'user_id' => 'nullable|integer|exists:users,id',
            'peminjam_nama' => 'nullable|string|max:255',

            'tgl_pinjam' => 'required|date',
            'keperluan' => 'nullable|string',

            'detail' => 'required|array|min:1',

            'detail.*.barang_id' => 'required|integer|exists:epinjam_barang,id',
            'detail.*.peruntukan' => 'nullable|string',
            'detail.*.tgl_kembali' => 'nullable|date',

        ], [
            'peminjam_type.required' => 'Tipe peminjam belum dipilih.',
            'detail.required' => 'Barang yang dipinjam belum dipilih.',
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

        if ($request->peminjam_type === 'user' && !$request->user_id) {
            return response()->json([
                'message' => 'Pegawai peminjam belum dipilih.'
            ], 422);
        }

        if ($request->peminjam_type === 'manual' && !$request->peminjam_nama) {
            return response()->json([
                'message' => 'Nama peminjam manual belum diisi.'
            ], 422);
        }

        $barangIds = collect($request->detail)->pluck('barang_id')->toArray();

        // cek apakah barang masih dipinjam (status = 1)
        $barangDipakai = \DB::table('epinjam_list')
            ->whereIn('id_barang', $barangIds)
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->pluck('id_barang')
            ->toArray();

        if (count($barangDipakai) > 0) {

            $namaBarang = \DB::table('epinjam_barang')
                ->whereIn('id', $barangDipakai)
                ->pluck('nama')
                ->implode(', ');

            return response()->json([
                'message' => 'Barang masih dalam peminjaman: ' . $namaBarang
            ], 422);
        }

        DB::beginTransaction();

        try {

            $userPinjam = null;
            $namaUserPinjam = null;

            if ($request->peminjam_type === 'manual') {
                $namaUserPinjam = $request->peminjam_nama;
            } else {
                $userPinjam = $request->user_id;

                $user = User::find($userPinjam);
                $namaUserPinjam = $user?->nama; // snapshot nama
            }

            $pinjam = epinjam::create([
                'user_pinjam'        => $userPinjam,
                'nama_user_pinjam'   => $namaUserPinjam,
                'user_admin_pinjam'  => auth()->id(),
                'tgl_pinjam'         => $request->tgl_pinjam,
                'keperluan'          => $request->keperluan,
                'status'             => 1,
            ]);

            $detail = [];

            foreach ($request->detail as $item) {

                $detail[] = [
                    'id_barang'            => $item['barang_id'],
                    'jumlah'               => 1,
                    'tgl_rencana_kembali'  => $item['tgl_kembali'] ?: null,
                    'peruntukan'           => $item['peruntukan'],
                    'status'               => 1,
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

    public function ubah($id)
    {
        $barang = epinjam_kategori::with('barang')->get();
        $show = epinjam::with([
            'list.barang.kategori',
            'list.barang',
            'userPinjam:id,nama,name',
            'userPinjam.roles:id,name',
            'userAdminPinjam:id,nama',
            'userKembali:id,nama',
            'userAdminKembali:id,nama',
        ])->findOrFail($id);
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
            'show' => $show,
            'users' => $users,
        ];

        return response()->json($data, 200);
    }

    public function prosesUbah(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'peminjam_type' => 'required|in:user,manual',
            'user_id' => 'nullable|integer|exists:users,id',
            'peminjam_nama' => 'nullable|string|max:255',
            'tgl_pinjam' => 'required|date',
            'keperluan' => 'nullable|string',
            'detail' => 'required|array|min:1',
            'detail.*.barang_id' => 'required|integer|exists:epinjam_barang,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $pinjam = epinjam::findOrFail($id);

            // update master
            $pinjam->update([
                'user_pinjam' => $request->peminjam_type === 'user' ? $request->user_id : null,
                'nama_user_pinjam' => $request->peminjam_type === 'manual'
                    ? $request->peminjam_nama
                    : User::find($request->user_id)?->nama,
                'tgl_pinjam' => $request->tgl_pinjam,
                'keperluan' => $request->keperluan,
            ]);

            // HAPUS DETAIL LAMA
            $pinjam->list()->delete();

            // INSERT DETAIL BARU
            $detail = [];

            foreach ($request->detail as $item) {
                $detail[] = [
                    'id_epinjam' => $pinjam->id,
                    'id_barang' => $item['barang_id'],
                    'jumlah' => 1,
                    'tgl_rencana_kembali' => $item['tgl_kembali'] ?? null,
                    'peruntukan' => $item['peruntukan'] ?? null,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            epinjam_list::insert($detail);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:epinjam,id',
            'status' => 'required|boolean'
        ]);

        DB::beginTransaction();

        try {

            $pinjam = epinjam::findOrFail($request->id);

            if ($pinjam->status == 0 && $request->status == 1) {
                return response()->json([
                    'message' => 'Peminjaman sudah selesai, barang tidak dapat diaktifkan kembali.'
                ], 422);
            }

            // Update seluruh detail barang
            epinjam_list::where('id_epinjam', $pinjam->id)
                ->update([
                    'status' => $request->status
                ]);

            // Update header
            $pinjam->update([
                'user_admin_kembali' => Auth::id(),
                'tgl_kembali' => now(),
                'status' => $request->status
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status barang berhasil diupdate'
            ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function hapus($id)
    {
        DB::beginTransaction();

        try {

            $pinjam = epinjam::with('list')->findOrFail($id);

            // update semua list
            foreach ($pinjam->list as $item) {
                $item->update([
                    'status' => 0
                ]);

                $item->delete(); // soft delete
            }

            // update status master
            $pinjam->update([
                'status' => 0
            ]);

            $pinjam->delete(); // soft delete epinjam

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
}
