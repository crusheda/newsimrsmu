<?php

namespace App\Http\Controllers\v4\SDI;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\kepegawaian\surtug;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth,Validator,Redirect,Response,Storage,File;

class SurtugController extends Controller
{
    function index()
    {
        $users  = users::where('nik','!=',null)
                        ->where('nip','!=',null)
                        ->where(function ($q) {
                            $q->where('status', '!=', 99)
                            ->orWhereNull('status');
                        })
                        ->whereNull('deleted_at')
                        ->orderBy('nama', 'asc')->get();

        $data = [
            'users' => $users,
        ];

        return view('pages.v4.sdi.surtug.index')->with('list', $data);
    }

    function table()
    {
        $user = Auth::user();

        if ($user->can('admin_kepegawaian')) {
            $show = surtug::join('users','users.id','=','kepegawaian_surtug.user')
                            ->select('kepegawaian_surtug.*','users.nama as nama_user')
                            ->orderBy('kepegawaian_surtug.updated_at','desc')
                            ->get();
        } else {
            $show = surtug::join('users','users.id','=','kepegawaian_surtug.user')
                            ->select('kepegawaian_surtug.*','users.nama as nama_user')
                            ->whereJsonContains('kepegawaian_surtug.pegawai_id', (string) $user->id)
                            ->orderBy('kepegawaian_surtug.updated_at','desc')
                            ->get();
        }

        $users  = users::where('nik','!=',null)->where('nip','!=',null)->orderBy('nama', 'asc')->get();

        $data = [
            'show' => $show,
            'users' => $users,
        ];

        return response()->json($data);
    }

    function simpan(Request $request)
    {
        $user = Auth::user()->id;
        $push = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $request->validate([
            'file' => ['max:3000'],
        ]);
        $uploadedFile = $request->file('file');
        $title = $uploadedFile->getClientOriginalName();
        $validasi = surtug::where('title',$title)->count();
        if ($validasi > 0) {
            return Response::json(array(
                'message' => 'File sudah pernah diupload, periksa dokumen Anda sekali lagi.',
                'code' => 400,
            ));
        } else {
            $path = $uploadedFile->store('public/files/kepegawaian/surtug');

            $data = new surtug;
            $data->tgl = Carbon::now();
            $data->user = $user;
            $data->pegawai_id = $request->pegawai;
            $data->title = $title;
            $data->filename = $path;
            $data->save();

            datalogs::record($user, 'Baru saja melakukan penambahan Surat Tugas', $request->pegawai_id, null, $title, '["kepala-sumber-daya-insani","staf-sumber-daya-insani"]');
            return Response::json(array(
                'message' => $push,
                'code' => 200,
            ));
        }
    }

    public function download($id)
    {
        $data = surtug::find($id);
        return Storage::download($data->filename, $data->title);
    }

    function ubah($id)
    {
        $show = surtug::find($id);
        $users  = users::where('nik','!=',null)->where('nip','!=',null)->orderBy('nama', 'asc')->get();

        $data = [
            'show' => $show,
            'users' => $users,
        ];

        return response()->json($data);
    }

    function prosesUbah(Request $request)
    {
        $user = Auth::user()->id;
        $push = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $file = null;
        $title = null;

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => ['max:3000'],
            ]);
            $file = $request->file('file');
        }

        if ($file) {
            $title = $file->getClientOriginalName();
            $validasi = surtug::where('title',$title)->count();
            if ($validasi > 0) {
                return Response::json(array(
                    'message' => 'File sudah pernah diupload, periksa dokumen Anda sekali lagi.',
                    'code' => 400,
                ));
            }
            $hapusFileOld = surtug::find($request->id);
            Storage::delete($hapusFileOld->filename);
        }

        $data = surtug::find($request->id);
        // $data->tgl = Carbon::now();
        $data->user = $user;
        $data->pegawai_id = $request->pegawai;
        if ($file) {
            $path = $file->store('public/files/kepegawaian/surtug');
            $data->title = $title;
            $data->filename = $path;
        }
        $data->save();

        datalogs::record($user, 'Baru saja melakukan perubahan Surat Tugas', $request->pegawai_id, null, $title, '["kepala-sumber-daya-insani","staf-sumber-daya-insani"]');
        return Response::json(array(
            'message' => $push,
            'code' => 200,
        ));
    }

    function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = surtug::find($id);

        // Proses Hapus Lampiran
        Storage::delete($data->filename);

        // Hapus Record DB
        $data->delete();

        return response()->json($tgl, 200);
    }
}
