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

class EPinjamAsalController extends Controller
{
    function index()
    {
        $user = Auth::user();

        if ($user->can('epinjam_admin')) {
            return view('pages.v4.it.epinjam.ref.asal');
        } else {
            return redirect()->back();
        }
    }

    function table()
    {
        $show = epinjam_asal::with(['barang:id_asal,nama','user:id,nama'])->latest()->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    public function getUbah($id)
    {
        $asal = epinjam_asal::find($id);

        if (!$asal) {
            return response()->json([
                'message' => 'Data Unit Asal tidak ditemukan.'
            ], 404);
        }

        return response()->json($asal, 200);
    }

    public function ubah(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:epinjam_asal,id',
            'asal' => 'required',

        ], [

            'id.required' => 'ID Unit Asal tidak ditemukan.',
            'asal.required' => 'Nama Unit Asal wajib diisi.',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);

        }

        DB::beginTransaction();

        try {

            $asal = epinjam_asal::findOrFail($request->id);

            $asal->update([
                'unit' => $request->asal,
                'user' => auth()->id()
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Data Unit Asal berhasil diperbarui.'
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
            'asal' => 'required',
        ], [
            'asal.required' => 'Nama Unit Asal wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        DB::beginTransaction();

        try {

            epinjam_asal::create([
                'unit' => $request->asal,
                'user' => auth()->id(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Referensi asal berhasil ditambahkan.'
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

        $data = epinjam_asal::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data Unit Asal tidak ditemukan.'
            ], 404);
        }

        $data->status = 0;
        $data->save();

        $data->delete();

        return response()->json($tgl, 200);
    }
}
