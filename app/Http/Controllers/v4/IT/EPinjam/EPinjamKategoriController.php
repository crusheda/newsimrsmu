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

    function table()
    {
        $show = epinjam_kategori::with(['barang:id_kategori,nama','user:id,nama'])->latest()->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    public function getUbah($id)
    {
        $kategori = epinjam_kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Data kategori tidak ditemukan.'
            ], 404);
        }

        return response()->json($kategori, 200);
    }

    public function ubah(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:epinjam_kategori,id',
            'kategori' => 'required',

        ], [

            'id.required' => 'ID kategori tidak ditemukan.',
            'kategori.required' => 'Kategori wajib diisi.',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);

        }

        DB::beginTransaction();

        try {

            $kategori = epinjam_kategori::findOrFail($request->id);

            $kategori->update([
                'nama' => $request->kategori,
                'user' => auth()->id()
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Data kategori berhasil diperbarui.'
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
        ], [
            'kategori.required' => 'Kategori wajib dipilih.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        DB::beginTransaction();

        try {

            epinjam_kategori::create([
                'nama' => $request->kategori,
                'user' => auth()->id(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Referensi kategori berhasil ditambahkan.'
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

        $data = epinjam_kategori::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data kategori tidak ditemukan.'
            ], 404);
        }

        $data->status = 0;
        $data->save();

        $data->delete();

        return response()->json($tgl, 200);
    }
}
