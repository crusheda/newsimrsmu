<?php

namespace App\Http\Controllers\v4\SDI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\User;
use App\Models\users;
use App\Models\users_status;
use App\Models\users_spkrkk;
use App\Models\logs;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class SpkRkkController extends Controller
{
    function index() // TAMPILAN HALAMAN DETAIL PROFIL KEPEGAWAIAN
    {
        $users  = users::where('nik','!=',null)
                        ->where('nama','!=',null)
                        ->where('nip','!=',null)
                        ->where(function ($q) {
                            $q->where('status', '!=', 99)
                            ->orWhereNull('status');
                        })
                        ->whereNull('deleted_at')
                        ->orderBy('nama', 'asc')
                        ->get();

        $data = [
            'users' => $users,
        ];

        return view('pages.v4.sdi.spkrkk.index')->with('list', $data);
    }

    function tableSpkRkk()
    {
        $show = users_spkrkk::withTrashed()
                ->join('users as u','u.id','=','users_spkrkk.pegawai_id')
                ->join('users as us','us.id','=','users_spkrkk.user_id')
                ->select('u.nama as nama_pegawai','us.nama as nama_kepegawaian','users_spkrkk.*')
                // ->where('users_spkrkk.pegawai_id',Auth::id())
                ->orderBy('users_spkrkk.updated_at','desc')
                ->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function tambahSpkRkk(Request $request)
    {
        $now = Carbon::now();
        $user_id = Auth::user()->id;
        $tgl = $now->isoFormat('dddd, D MMMM Y, HH:mm a');

        // VALIDASI DATA
        $request->validate([
            'file' => ['max:3000'], // 'mimes:jpeg,jpg,png'
        ]);

        // Validasi AWAL
        $cekStatus = users_status::join('referensi as ref','users_status.ref_id','=','ref.id')
                                ->select('ref.queue','users_status.*')
                                ->where('users_status.pegawai_id','=', $request->pegawai_id)
                                ->where('users_status.status',1)
                                ->first();

        if (!$cekStatus) {
            return response()->json(['status' => false, 'message' => 'Dimohon untuk melengkapi Data Status Kepegawaian terlebih dahulu pada Menu Penetapan'], 422);
        }

        $validasi = users_spkrkk::where('pegawai_id',$request->pegawai_id)->where('jns_dokumen',$request->jns_dokumen)->orderBy('created_at','desc')->first();
        if (!empty($validasi) || $validasi != '') {
            $validasi->status = 0;
            $validasi->save();
        }

        // $getStatusPegawai = users_status::from('users_status as uss')
        //                                     ->where('uss.pegawai_id','=',$request->pegawai_id)
        //                                     ->where('uss.status',1)
        //                                     ->first();

        // SAVING DATA
        $data = new users_spkrkk;
        $data->user_id = $user_id;
        $data->pegawai_id = $request->pegawai_id;

        // if (!empty($getStatusPegawai) || $getStatusPegawai != '') {
        //     $data->pegawai_status = $getStatusPegawai->ref_id;
        // } else {
        //     $data->pegawai_status = null;
        // }

        $data->pegawai_status = $cekStatus->queue; // AMBIL ID REFERENSI STATUS PEGAWAI DARI TABLE USERS_STATUS.QUEUE

        $data->tgl_berakhir = $request->tgl_berakhir;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->store('public/files/kepegawaian/spkrkk/'.$request->pegawai_id);
            $title = $file->getClientOriginalName();
            $data->filename = json_encode($filename);
            $data->title = json_encode($title);
        }
        $data->jns_dokumen = $request->jns_dokumen;
        $data->deskripsi = $request->deskripsi;
        $data->status = true;
        $data->save();

        // CEK DATA & SAVE LOG
        $cekPegawai = users::find($request->pegawai_id);
        if ($request->jns_dokumen == 0) {
            $jns = 'SPK & RKK';
        } else {
            $jns = 'Dokumen Lain';
        }
        $berakhir = null;
        if (!empty($request->tgl_berakhir) || $request->tgl_berakhir != '') {
            $berakhir = 'Berakhir pada tanggal '.$request->tgl_berakhir;
        }

        datalogs::record($user_id, 'Baru saja melakukan penambahan '.$jns.' pada Data Pegawai '.$cekPegawai->nama, $berakhir, null, $data, '["kepala-sumber-daya-insani","staf-sumber-daya-insani"]');

        return response()->json($tgl, 200);
    }

    function showUbahSpkRkk($id)
    {
        $show = users_spkrkk::where('id', $id)->first();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function ubahSpkRkk(Request $request)
    {
        $now = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');
        $user_id = Auth::user()->id;

        $data = users_spkrkk::find($request->id);
        $pushData = $data;
        $pushPegawai = users::where('id',$data->pegawai_id)->first();

        if ($request->pegawai_status) {
            $data->pegawai_status   = $request->pegawai_status;
        }

        $data->tgl_berakhir   = $request->tgl_berakhir;
        $data->jns_dokumen    = $request->jns_dokumen;
        $data->user_id        = $user_id;
        $data->deskripsi      = $request->deskripsi;
        $data->save();

        // CEK DATA & SAVE LOG
        $cekData = referensi::find($request->ref_id);
        datalogs::record($user_id, 'Baru saja melakukan perubahan Dokumen SPK RKK Pegawai : '.$pushPegawai->nama.' pada record ID : '.$request->id, null, $pushData, $data, '["kepala-sumber-daya-insani","staf-sumber-daya-insani"]');

        return response()->json($now, 200);
    }

    function hapusSpkRkk($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $user_id = Auth::user()->id;

        // Inisialisasi
        $data = users_spkrkk::find($id);
        $pushData = $data;
        $pushPegawai = users::where('id',$data->pegawai_id)->first();

        if ($data->jns_dokumen == 0) {
            $jns = 'SPK & RKK';
        } else {
            $jns = 'Dokumen Lain';
        }

        // Proses Hapus Data dari DB
        $data->status = 0;
        $data->save();
        Storage::delete(json_decode($data->filename));
        $data->delete();

        // CEK DATA & SAVE LOG
        $cekData = referensi::find($data->ref_id);
        datalogs::record($user_id, 'Baru saja melakukan penghapusan '.$jns.' Pegawai : '.$pushPegawai->nama, null, $pushData, $data, '["kepala-sumber-daya-insani","staf-sumber-daya-insani"]');

        return response()->json($tgl, 200);
    }

}
