<?php

namespace App\Http\Controllers\v4\Administrasi\ERuang;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\eruang_ref;
use App\Models\eruang;
use App\Models\roles;
use App\Models\User;
use Carbon\Carbon;
use Storage;
use Auth;
use \PDF;
use Validator,Redirect,Response,File;

class ERuangController extends Controller
{
    function index()
    {
        $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();
        $show = eruang::get();
        $ruangan = eruang_ref::orderBy('nama','ASC')->get();

        $data = [
            'role' => $role,
            'show' => $show,
            'ruangan' => $ruangan,
        ];

        return view('pages.v4.administrasi.eruang.index')->with('list',$data);
    }

    function cekKetersediaan(Request $request)
    {
        try {
            $start = Carbon::parse($request->tgl_mulai);
            $end   = Carbon::parse($request->tgl_selesai);

            if ($end < $start) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tanggal tidak valid'
                ]);
            }

            $data = eruang::select('eruang.*','users.nama as nama_user')
                ->join('users','users.id','=','eruang.id_user')
                ->where('id_ruangan', $request->ruangan)
                ->whereNull('status_penolakan')
                ->where(function ($q) use ($start, $end) {
                    // 🔥 overlap tanggal
                    $q->whereBetween('tgl_mulai', [$start, $end])
                    ->orWhereBetween('tgl_selesai', [$start, $end])
                    ->orWhere(function ($q2) use ($start, $end) {
                        $q2->where('tgl_mulai', '<=', $start)
                            ->where('tgl_selesai', '>=', $end);
                    });
                })
                ->get();

            $disabledRanges = [];

            foreach ($data as $item) {

                // 🔥 overlap jam
                if (
                    ($request->jam_mulai < substr($item->jam_selesai,0,5)) &&
                    ($request->jam_selesai > substr($item->jam_mulai,0,5))
                ) {
                    $tglMulai = Carbon::parse($item->tgl_mulai)->translatedFormat('d F Y');
                    $tglSelesai = Carbon::parse($item->tgl_selesai)->translatedFormat('d F Y');

                    $jamMulai = Carbon::parse($item->jam_mulai)->format('H:i');
                    $jamSelesai = Carbon::parse($item->jam_selesai)->format('H:i');

                    if ($item->tgl_mulai == $item->tgl_selesai) {
                        $textTanggal = 'pada '.$tglMulai;
                    } else {
                        $textTanggal = 'pada '.$tglMulai.' s/d '.$tglSelesai;
                    }

                    return response()->json([
                        'status' => false,
                        'message' => 'Bentrok dengan Agenda '.$item->agenda.
                                    ' (Pukul '.$jamMulai.' - '.$jamSelesai.' WIB) '.
                                    $textTanggal.'. Dipesan oleh '.$item->nama_user.
                                    ', Silakan memilih jadwal lain yang tersedia.'
                    ]);
                }

                // untuk frontend disable jam
                $disabledRanges[] = [
                    'start' => substr($item->jam_mulai, 0, 5),
                    'end'   => substr($item->jam_selesai, 0, 5),
                ];
            }

            return response()->json([
                'status' => true,
                'message' => 'Jadwal Pemesanan Ruangan tersedia, silakan melanjutkan proses pengajuan',
                'disabled_ranges' => $disabledRanges
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat proses pengecekan ketersediaan ruangan',
                'error' => $e->getMessage()
            ]);
        }
    }

    function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // ================= VALIDASI BASIC =================
            if (
                !$request->ruangan ||
                !$request->agenda ||
                !$request->tgl ||
                !$request->jam_mulai ||
                !$request->jam_selesai
            ) {
                return response()->json([
                    'message' => 'Field wajib tidak boleh kosong',
                    'code' => 400
                ]);
            }

            if (!is_numeric($request->ruangan)) {
                return response()->json([
                    'message' => 'Ruangan tidak valid',
                    'code' => 400
                ]);
            }

            // ================= FORMAT TANGGAL =================
            $tglArr = explode(' to ', $request->tgl);

            try {
                $start = Carbon::parse($tglArr[0]);
                $end   = isset($tglArr[1]) ? Carbon::parse($tglArr[1]) : Carbon::parse($tglArr[0]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Format tanggal salah',
                    'code' => 400
                ]);
            }

            if ($end < $start) {
                return response()->json([
                    'message' => 'Tanggal akhir tidak boleh lebih kecil dari tanggal mulai',
                    'code' => 400
                ]);
            }

            // ================= VALIDASI JAM =================
            try {
                $jamMulai   = Carbon::createFromFormat('H:i', $request->jam_mulai);
                $jamSelesai = Carbon::createFromFormat('H:i', $request->jam_selesai);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Format jam tidak valid',
                    'code' => 400
                ]);
            }

            if ($jamMulai >= $jamSelesai) {
                return response()->json([
                    'message' => 'Jam selesai harus lebih besar dari jam mulai',
                    'code' => 400
                ]);
            }

            // ================= VALIDASI OVERLAP =================
            $exists = eruang::where('id_ruangan', $request->ruangan)
                ->whereNull('status_penolakan')
                ->lockForUpdate()
                ->where(function ($q) use ($start, $end) {
                    // overlap tanggal
                    $q->whereBetween('tgl_mulai', [$start, $end])
                    ->orWhereBetween('tgl_selesai', [$start, $end])
                    ->orWhere(function ($q2) use ($start, $end) {
                        $q2->where('tgl_mulai', '<=', $start)
                            ->where('tgl_selesai', '>=', $end);
                    });
                })
                ->where(function ($q) use ($request) {
                    // overlap jam
                    $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q2) use ($request) {
                        $q2->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
                })
                ->first();

            if ($exists) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Jadwal bentrok dengan booking lain',
                    'code' => 400
                ]);
            }

            // ================= FORMAT GIZI =================
            $gizi = [];
            if ($request->snack > 0) $gizi[] = "Snack : ".$request->snack;
            if ($request->makan > 0) $gizi[] = "Makan : ".$request->makan;
            if ($request->minum > 0) $gizi[] = "Minum : ".$request->minum;

            $gizi = implode("\n", $gizi);

            // ================= SIMPAN =================
            eruang::create([
                'id_user'      => Auth::id(),
                'id_ruangan'   => $request->ruangan,
                'agenda'       => $request->agenda,
                'tgl'          => $start->format('Y-m-d'),
                'tgl_mulai'    => $start->format('Y-m-d'),
                'tgl_selesai'  => $end->format('Y-m-d'),
                'jam_mulai'    => $request->jam_mulai,
                'jam_selesai'  => $request->jam_selesai,
                'ket'          => $request->ket,
                'gizi'         => $gizi,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Peminjaman berhasil',
                'code' => 200
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage(),
                'code' => 500
            ]);
        }
    }

    function table()
    {
        $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();
        $show = eruang::select('eruang.*','users.nama as nama_user','users.no_hp','eruang_ref.nama as nama_ruangan','eruang_ref.kapasitas')
                    ->join('users','users.id','=','eruang.id_user')
                    ->join('eruang_ref','eruang_ref.id','=','eruang.id_ruangan')
                    ->orderBy('eruang.updated_at','DESC')
                    ->get();
        // $ruangan = eruang_ref::orderBy('nama','ASC')->get();

        $data = [
            'role' => $role,
            'show' => $show,
            // 'ruangan' => $ruangan,
        ];

        return response()->json($data);
    }

    function getUbah($id)
    {
        $show = eruang::select('eruang.*','users.nama as nama_user','eruang_ref.id as id_ruangan_ref','eruang_ref.nama as nama_ruangan','eruang_ref.kapasitas')
                    ->join('users','users.id','=','eruang.id_user')
                    ->join('eruang_ref','eruang_ref.id','=','eruang.id_ruangan')
                    ->where('eruang.id',$id)
                    ->orderBy('eruang.updated_at','DESC')
                    ->first();

        $ruangan = eruang_ref::orderBy('nama','ASC')->get();

        $data = [
            'show' => $show,
            'ruangan' => $ruangan,
        ];

        return response()->json($data, 200);
    }

    function ubah(Request $request)
    {
        $data = eruang::find($request->id);

        $data->id_user = $request->user;
        $data->id_ruangan = $request->ruangan;
        $data->agenda = $request->agenda;

        $data->tgl = $request->tgl_mulai; // fallback
        $data->tgl_mulai = $request->tgl_mulai;
        $data->tgl_selesai = $request->tgl_selesai;

        $data->jam_mulai = $request->jam_mulai;
        $data->jam_selesai = $request->jam_selesai;

        $data->ket = $request->ket;
        $data->gizi = $request->gizi;

        // 🔥 VALIDASI BENTROK (WAJIB!)
        $cek = eruang::where('id_ruangan', $request->ruangan)
            ->where('id', '!=', $request->id)
            ->where(function($q) use ($request) {
                $q->whereBetween('tgl_mulai', [$request->tgl_mulai, $request->tgl_selesai])
                ->orWhereBetween('tgl_selesai', [$request->tgl_mulai, $request->tgl_selesai]);
            })
            ->where(function($q) use ($request) {
                $q->where('jam_mulai', '<', $request->jam_selesai)
                ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->exists();

        if ($cek) {
            return response()->json([
                'code' => 400,
                'message' => 'Jadwal bentrok dengan jadwal lain'
            ], 200);
        }

        $data->save();

        return response()->json(now()->format('Y-m-d H:i:s'), 200);
    }

    function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = eruang::find($id);
        $data->delete();

        return response()->json($tgl, 200);
    }

    function tolak(Request $request){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        // print_r($request->id);
        // die();
        // Inisialisasi
        $data = eruang::find($request->id);
        if ($data->gizi_verif != null) {
            return response()->json('Peminjaman Ruangan sudah diverifikasi oleh Gizi sehingga tidak dapat ditolak', 400);
        } else {
            $data->status_penolakan = true;
            $data->alasan_penolakan = $request->alasan;
            $data->save();
            return response()->json($tgl, 200);
        }
    }

    function display(Request $request)
    {
        // print_r("ini ruangan ".$request->ruangan.", dan tgl ".$request->tgl);
        // die();
        $input1 = $request->tgl;
        $input2 = $request->ruangan;
        $input3 = $request->status;
        $tigahariyanglalu = Carbon::now()->subDays(3)->isoFormat('YYYY-MM-DD'); // 28-05-2024 menjadi 2024-05-28
        // if ($request->status != 1) {
        //     $input3 = null;
        // } else {
        //     $input3 = $request->status;
        // }

        $show = eruang::select('eruang.*','users.nama as nama_user','users.no_hp','users_foto.filename as foto_profil','eruang_ref.id as id_ruangan_ref','eruang_ref.nama as nama_ruangan','eruang_ref.kapasitas')
                ->leftJoin('users','users.id','=','eruang.id_user')
                ->leftJoin('users_foto','users.id','=','users_foto.user_id')
                ->join('eruang_ref','eruang_ref.id','=','eruang.id_ruangan')
                ->when($input1 != null, function ($q) use ($input1) {
                    $q->where('eruang.tgl',$input1);
                })
                ->when($input2 != null, function ($q) use ($input2) {
                    $q->where('eruang.id_ruangan',$input2);
                })
                // ->when($input3 != 0, function ($q) use ($input3) {
                //     $q->where('eruang.tgl','>=',$tigahariyanglalu);
                // })
                ->when($input3 == 0, function ($q) use ($input3) {
                    // $q->where('eruang.status_penolakan',null);
                    $q->orderBy('eruang.tgl','desc');
                    $q->orderBy('eruang.jam_mulai','desc');
                })
                ->when($input3 == 1, function ($q) use ($input3,$tigahariyanglalu) {
                    $q->where('eruang.status_penolakan',null);
                    $q->where('gizi_verif',null);
                    $q->where('eruang.tgl','>=',$tigahariyanglalu);
                    $q->orderBy('eruang.tgl','asc');
                    $q->orderBy('eruang.jam_mulai','asc');
                    $q->limit(9);
                })
                ->when($input3 == 2, function ($q) use ($input3) {
                    $q->where('eruang.status_penolakan',null);
                    $q->where('gizi_verif',1);
                    $q->orderBy('eruang.tgl','asc');
                    $q->orderBy('eruang.jam_mulai','asc');
                    $q->limit(9);
                })
                ->when($input3 == 3, function ($q) use ($input3) {
                    $q->where('status_penolakan',1);
                    $q->orderBy('eruang.tgl','desc');
                    $q->orderBy('eruang.jam_mulai','desc');
                    // $q->limit(9);
                })
                // if ($input3 == 1) {
                //     $show->where('eruang.gizi_verif',1);
                // } else {
                //     if ($input3 == 2) {
                //         $show->where('eruang.gizi_verif',null);
                //     }
                // }
                // ->orderBy('eruang.tgl','asc')
                // ->orderBy('eruang.jam_mulai','asc')
                // ->limit(9)
                ->get();
        $now = Carbon::now()->isoFormat('HH:mm:ss');

        $data = [
            'show' => $show,
            'now' => $now,
        ];

        return response()->json($data, 200);
    }

    function verifGizi($id){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = eruang::find($id);
        $data->gizi_verif = true;
        $data->save();

        return response()->json($tgl, 200);
    }

    function verifEditHapus($id){
        // Inisialisasi
        $data = eruang::find($id);
        return response()->json($data, 200);
    }

    ///////////////////////////////////////////////////////// DAFTAR RUANGAN
    function indexRuangan()
    {
        if (Auth::user()->can('admin_eruang')) {
            $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();
            // $show = eruang::get();
            $ruangan = eruang_ref::orderBy('nama','ASC')->get();

            $data = [
                'role' => $role,
                // 'show' => $show,
                'ruangan' => $ruangan,
            ];

            return view('pages.v4.administrasi.eruang.ruangan')->with('list',$data);
        } else {
            return redirect()->back()->withErrors('Maaf, Anda tidak memiliki akses daftar ruangan');
        }
    }

    function getRuangan()
    {
        $user = Auth::user();

        $roleIds = $user->roles->pluck('id')
            ->map(fn($id) => (string) $id)
            ->toArray();

        $show = eruang_ref::where(function($q) use ($roleIds) {

                // ✅ akses NULL (semua boleh lihat)
                $q->whereNull('akses');

                // ✅ akses tidak null & cocok dengan role user
                if (!empty($roleIds)) {
                    $q->orWhere(function($q2) use ($roleIds) {
                        foreach ($roleIds as $roleId) {
                            $q2->orWhereJsonContains('akses', $roleId);
                        }
                    });
                }

            })
            ->orderBy('nama','ASC')
            ->get();

        if (!$show->isNotEmpty()) {
            return response()->json([
                'message' => 'Maaf, tidak ada ruangan yang dapat ditampilkan untuk Anda.',
            ], 404);
        }

        return response()->json([
            'show' => $show,
        ], 200);
    }

    function storeRuangan(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = new eruang_ref;
        $data->nama = $request->ruangan;
        $data->deskripsi = $request->deskripsi;
        $data->kapasitas = $request->kapasitas;
        $data->fasilitas = $request->fasilitas;
        if ($request->akses) {
            $data->akses = json_encode($request->akses);
        } else {
            $data->akses = null;
        }
        $data->save();

        return response()->json($tgl, 200);
    }

    function getUbahRuangan($id)
    {
        $show = eruang_ref::where('id',$id)->first();
        $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();

        $data = [
            'show' => $show,
            'role' => $role,
        ];

        return response()->json($data, 200);
    }

    function updateRuangan(Request $request) {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = eruang_ref::find($request->id);
        $data->nama = $request->ruangan;
        $data->deskripsi = $request->deskripsi;
        $data->kapasitas = $request->kapasitas;
        $data->fasilitas = $request->fasilitas;
        if ($request->akses != '') {
            $data->akses = "[".str_replace(',','","',json_encode($request->akses))."]";
        } else {
            $data->akses = null;
        }


        $data->save();

        return response()->json($tgl, 200);
    }

    function destroyRuangan($id) {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $hapusData = eruang_ref::find($id);
        $hapusData->delete();

        return response()->json($tgl, 200);
    }
}
