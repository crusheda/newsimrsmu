<?php

namespace App\Http\Controllers\v4\IT\EPinjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\referensi;
use App\Models\epinjam;
use App\Models\epinjam_list;
use App\Models\epinjam_barang;
use App\Models\epinjam_asal;
use App\Models\epinjam_kategori;
use Carbon\Carbon;
use Auth, Redirect, Storage;

class EPinjamBarangController extends Controller
{
    function index()
    {
        $user = Auth::user();

        if ($user->can('epinjam_admin')) {
            return view('pages.v4.it.epinjam.ref.barang');
        } else {
            return redirect()->back();
        }
    }

    function table()
    {
        $show = epinjam_barang::with([
            'kategori:id,nama',
            'asal:id,unit',
            'kondisi:queue,deskripsi',
            'user:id,nama',
        ])
        ->latest()
        ->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function loadTambah()
    {
        $kategori = epinjam_kategori::where('status',1)->orderBy('nama','ASC')->get();
        $asal = epinjam_asal::where('status',1)->orderBy('unit','ASC')->get();
        $kondisi = referensi::where('ref_jenis', 15)->where('status',1)->orderBy('queue','ASC')->get();

        $data = [
            'kategori' => $kategori,
            'asal' => $asal,
            'kondisi' => $kondisi,
        ];

        return response()->json($data, 200);
    }

    public function getUbah($id)
    {
        $barang = epinjam_barang::find($id);

        if (!$barang) {
            return response()->json([
                'message' => 'Data barang tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'barang' => $barang,
            'kategori' => epinjam_kategori::where('status', 1)
                ->orderBy('nama')
                ->get(),
            'asal' => epinjam_asal::where('status', 1)
                ->orderBy('unit')
                ->get(),
            'kondisi' => referensi::where('ref_jenis', 15)
                ->orderBy('queue')
                ->get()
        ]);
    }

    public function ubah(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:epinjam_barang,id',
            'id_kategori' => 'required|exists:epinjam_kategori,id',
            'id_asal' => 'required',
            'nama' => 'required|max:500',

        ], [

            'id.required' => 'ID barang tidak ditemukan.',
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_asal.required' => 'Unit asal wajib dipilih.',
            'nama.required' => 'Nama barang wajib diisi.'

        ]);

        if ($validator->fails()) {

            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);

        }

        DB::beginTransaction();

        try {

            $barang = epinjam_barang::findOrFail($request->id);

            $barang->update([
                'id_kategori' => $request->id_kategori,
                'id_asal' => $request->id_asal,
                'kondisi' => $request->kondisi ?? 1,
                'nama' => trim($request->nama),
                'kelengkapan' => $request->kelengkapan,
                'user' => auth()->id()
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Data barang berhasil diperbarui.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required',
            'asal' => 'required',
            'nama' => 'required|max:255',
        ], [
            'kategori.required' => 'Kategori wajib dipilih.',
            'asal.required' => 'Unit asal wajib dipilih.',
            'nama.required' => 'Nama barang wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        DB::beginTransaction();

        try {

            epinjam_barang::create([
                'id_kategori' => $request->kategori,
                'id_asal' => $request->asal,
                'kondisi' => $request->kondisi,
                'nama' => $request->nama,
                'kelengkapan' => $request->kelengkapan,
                'user' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Referensi barang berhasil ditambahkan.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = epinjam_barang::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data barang tidak ditemukan.'
            ], 404);
        }

        if ($data->filename != null) {
            Storage::delete($data->filename);
        }

        $data->delete();

        return response()->json($tgl, 200);
    }
}
