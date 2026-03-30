<?php

namespace App\Http\Controllers\v4\Administrasi\Pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\RedirectResponse;
use App\Models\users;
use App\Models\pengadaan;
use App\Models\pengadaan_keranjang;
use App\Models\pengadaan_barang;
use App\Models\pengadaan_detail;
use App\Models\pengadaan_ref;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use \PDF;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = pengadaan::get();
        $ref = pengadaan_ref::get();

        $data = [
            'show' => $show,
            'ref' => $ref
        ];

        return view('pages.v4.administrasi.pengadaan.index')->with('list', $data);
    }

    // API
    public function grafikPengadaan($num = 1)
    {
        // num = 0 = DATA RS
        // num = 1 = DATA OWN

        $tahunIni = Carbon::now()->year;
        $tahunLalu = $tahunIni - 1;
        $duatahunLalu = $tahunIni - 2;

        $bulanIni = Carbon::now()->month;
        $bulanLalu = Carbon::now()->subMonth()->month;

        $data = Cache::remember('grafik_pengadaan_'.$tahunIni.'_'.$num, 60, function() use ($tahunIni, $tahunLalu, $duatahunLalu, $bulanIni, $bulanLalu, $num){

            $getData = function($tahun) use ($num) {
                return DB::table('pengadaan')
                    ->selectRaw('MONTH(tgl_pengadaan) as bulan, SUM(total) as total')
                    ->whereYear('tgl_pengadaan', $tahun)
                    ->when($num == 1, function ($query) {
                        $query->where('id_user', auth()->id());
                    })
                    ->groupBy(DB::raw('MONTH(tgl_pengadaan)'))
                    ->pluck('total', 'bulan')
                    ->toArray();
            };

            $dataTahunIni = $getData($tahunIni);
            $dataTahunLalu = $getData($tahunLalu);
            $dataDuaTahunLalu = $getData($duatahunLalu);

            $format = function($data){
                $result = [];
                for($i=1; $i<=12; $i++){
                    $result[] = isset($data[$i]) ? (int)$data[$i] : 0;
                }
                return $result;
            };

            // 👉 ambil bulan ini & bulan lalu
            $totalBulanIni  = $dataTahunIni[$bulanIni] ?? 0;
            $totalBulanLalu = $dataTahunIni[$bulanLalu] ?? 0;

            // 👉 ambil tahun ini & tahun lalu
            $totalTahunIni = array_sum($dataTahunIni);
            $totalTahunLalu = array_sum($dataTahunLalu);

            // 👉 hitung persen
            $persen = 0;
            if($totalBulanLalu > 0){
                $persen = (($totalBulanIni - $totalBulanLalu) / $totalBulanLalu) * 100;
            }

            return [
                'tahun_ini' => $format($dataTahunIni),
                'tahun_lalu' => $format($dataTahunLalu),
                'dua_tahun_lalu' => $format($dataDuaTahunLalu),
                // summary
                'bulan_ini' => $totalBulanIni,
                'bulan_lalu' => $totalBulanLalu,
                'total_tahun_ini' => $totalTahunIni,
                'total_tahun_lalu' => $totalTahunLalu,
                'persen' => round($persen, 1),
            ];
        });

        return response()->json($data);
    }

    public function getBarangPengadaan(Request $request)
    {
        $limit = $request->get('limit', 10);
        $page  = $request->get('page', 1);
        $search = $request->get('search');
        $jenis = $request->get('jenis');
        $harga = $request->get('harga');

        $query = DB::table('pengadaan_barang as pb')
            ->leftJoin('pengadaan_ref as pr', 'pb.ref_barang', '=', 'pr.id')
            ->leftJoin('users as u', 'pb.id_user', '=', 'u.id')
            ->select(
                'pb.id',
                'pb.nama',
                'pb.satuan',
                'pb.harga',
                'pb.filename',
                'pb.created_at',
                'pr.nama as jenis',
                'u.nama as user'
            )
            ->whereNull('pb.deleted_at');

        // 🔍 SEARCH
        // if($search){
        //     $query->where('pb.nama', 'like', "%$search%");
        // }
        if($search){
            $keywords = explode(' ', $search);

            $query->where(function($q) use ($keywords){
                foreach($keywords as $word){
                    $q->where('pb.nama', 'like', "%{$word}%");
                }
            });
        }

        // 🏷️ FILTER JENIS
        if($jenis && $jenis != 'all'){
            $query->where('pr.nama', $jenis);
        }

        // 💰 FILTER HARGA
        if($harga){
            if($harga == 'lt500'){
                $query->where('pb.harga', '<', 500000);
            } elseif($harga == '500_1jt'){
                $query->whereBetween('pb.harga', [500000, 1000000]);
            } elseif($harga == '1_10jt'){
                $query->whereBetween('pb.harga', [1000000, 10000000]);
            } elseif($harga == 'gt10jt'){
                $query->where('pb.harga', '>', 10000000);
            }
        }

        // 🔢 PAGINATION MANUAL
        $total = $query->count();

        $data = $query
            ->orderBy('pr.nama', 'asc')   // Jenis
            ->orderBy('pb.nama', 'asc')   // Nama Barang
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();

        return response()->json([
            "data" => $data,
            "total" => $total
        ]);
    }

    /// BATAS OLD NEW ----------------------------------------------------------
    function dataPengadaan($id)
    {
        $pengadaan = pengadaan::where('id_user', $id)->orderBy('tgl_pengadaan','desc')->get();
        // $detail_pengadaan = pengadaan::join('pengadaan_detail','pengadaan_detail.id_pengadaan','=','pengadaan.id_pengadaan')
        //                     ->where('id_user', $id)
        //                     ->select('pengadaan.id_user','pengadaan_detail.*')
        //                     ->get();

        $data = [
            'pengadaan' => $pengadaan,
            // 'detail_pengadaan' => $detail_pengadaan
        ];

        return response()->json($data, 200);
    }

    public function riwayatPengadaan()
    {
        $user = auth()->user();

        // Validasi user login
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        try {

            $query = pengadaan::query()
                ->join('users', 'users.id', '=', 'pengadaan.id_user')
                ->join('pengadaan_detail', function ($join) {
                    $join->on('pengadaan_detail.id_pengadaan', '=', 'pengadaan.id_pengadaan')
                    ->whereNull('pengadaan_detail.deleted_at');
                })
                ->leftJoin('pengadaan_barang', 'pengadaan_barang.id', '=', 'pengadaan_detail.id_barang')
                // ->leftJoin('pengadaan_barang', function ($join) {
                //     $join->on('pengadaan_barang.id', '=', 'pengadaan_detail.id_barang')
                //         ->whereNull('pengadaan_barang.deleted_at');
                // })
                ->select(
                    'pengadaan.id',
                    'users.nama as nama_user',
                    'pengadaan.unit',
                    'pengadaan.total',
                    'pengadaan.tgl_pengadaan',
                    'pengadaan_detail.id as detail_id',
                    'pengadaan_detail.id_barang',
                    'pengadaan_detail.jumlah',
                    'pengadaan_detail.harga',
                    'pengadaan_detail.satuan',
                    'pengadaan_detail.total as total_detail',
                    'pengadaan_detail.ket',
                    'pengadaan_barang.nama as nama_barang',
                    'pengadaan_barang.satuan as satuan_barang'
                )
                ->orderBy('pengadaan.tgl_pengadaan', 'desc');

            // 🔐 Filter berdasarkan role
            if (!$user->can('admin_pengadaan')) {
                $query->where('pengadaan.id_user', $user->id);
            }

            $result = $query->get();

            // 🔄 Grouping agar tidak "campur"
            $pengadaan = $result->groupBy('id')->map(function ($items) {
                return [
                    'id' => $items->first()->id,
                    'nama_user' => $items->first()->nama_user,
                    'unit' => $items->first()->unit,
                    'total' => $items->first()->total,
                    'tgl_pengadaan' => $items->first()->tgl_pengadaan,
                    'detail' => $items->map(function ($item) {
                        return [
                            'detail_id' => $item->detail_id,
                            'id_barang' => $item->id_barang,
                            'nama_barang' => $item->nama_barang,
                            'satuan_barang' => $item->satuan_barang,
                            'jumlah' => $item->jumlah,
                            'harga' => $item->harga,
                            'satuan' => $item->satuan,
                            'total' => $item->total_detail,
                            'ket' => $item->ket,
                        ];
                    })->values()
                ];
            })->values();

            return response()->json([
                'success' => true,
                'data' => $pengadaan
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    function hapusRiwayatPengadaan($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        pengadaan::where('id_pengadaan', $id)->delete();
        pengadaan_detail::where('id_pengadaan', $id)->delete();

        return response()->json($tgl, 200);
    }

    function copyPengadaan(Request $request) // AKAN MASUK KE KERANJANG
    {
        DB::beginTransaction();

        try {

            $user = auth()->user();

            // 🔍 Ambil pengadaan lama
            $pengadaan = pengadaan::where('id', $request->id_pengadaan)->first();

            if (!$pengadaan) {
                throw new \Exception('Data pengadaan tidak ditemukan');
            }

            if ($pengadaan->id_user != $user->id) {
                throw new \Exception('Copy riwayat pengadaan dari Pegawai Lain tidak diperbolehkan');
            }

            // 🔍 Ambil detailnya
            $details = pengadaan_detail::where('id_pengadaan', $pengadaan->id_pengadaan)
                        ->whereNull('deleted_at')
                        ->get();

            if ($details->isEmpty()) {
                throw new \Exception('Detail pengadaan kosong');
            }

            // 🧹 OPTIONAL: kosongkan keranjang user dulu
            pengadaan_keranjang::where('id_user', $user->id)->delete();

            // 🔁 Insert ke keranjang
            foreach ($details as $d) {

                // 🧹 OPTIONAL: kalau ada barang yg duplikat / sudah ada dikeranjang !!
                // $existing = pengadaan_keranjang::where('id_user', $user->id)
                //     ->where('id_barang', $d->id_barang)
                //     ->first();

                // if ($existing) {
                //     $existing->jumlah += $d->jumlah;
                //     $existing->total = $existing->jumlah * $existing->harga;
                //     $existing->save();
                // } else {
                //     pengadaan_keranjang::create([...]);
                // }

                pengadaan_keranjang::create([
                    'id_user'           => $user->id,
                    'id_barang'         => $d->id_barang,
                    'jml_permintaan'    => $d->jumlah,
                    'harga_barang'      => $d->harga,
                    'total_barang'      => $d->total,
                    'ket'               => $d->ket
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil copy ke keranjang'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    function tampilTambahKeranjang($id)
    {
        $barang = pengadaan_barang::where('id',$id)->first();

        return response()->json($barang, 200);
    }

    function tampilKeranjang()
    {
        $keranjang = pengadaan_keranjang::join('users','users.id','=','pengadaan_keranjang.id_user')
                                        ->join('pengadaan_barang','pengadaan_barang.id','=','pengadaan_keranjang.id_barang')
                                        ->join('pengadaan_ref','pengadaan_ref.id','=','pengadaan_barang.ref_barang')
                                        ->where('pengadaan_keranjang.id_user', auth()->id())
                                        ->select('pengadaan_keranjang.*','users.nama as nama_user','pengadaan_barang.nama as nama_barang','pengadaan_ref.nama as jenis','pengadaan_barang.satuan','pengadaan_barang.harga','pengadaan_barang.filename')
                                        ->orderBy('pengadaan_keranjang.id','asc')
                                        ->get();

        $data = [
            'keranjang' => $keranjang,
        ];

        return response()->json($data, 200);
    }

    function tambahKeranjang(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'jml' => 'required|integer|min:1'
        ]);

        $barang = pengadaan_barang::findOrFail($request->id_barang);

        $cek = pengadaan_keranjang::where('id_user', auth()->id())
                    ->where('id_barang', $request->id_barang)
                    ->first();

        if ($cek) {
            $cek->jml_permintaan += $request->jml;
            $cek->total_barang = $cek->jml_permintaan * $cek->harga_barang;

            // 🔥 update ket (optional overwrite / append)
            if ($request->ket) {
                $cek->ket = $request->ket;
            }

            $cek->save();

        } else {
            pengadaan_keranjang::create([
                'id_user' => auth()->id(),
                'id_barang' => $request->id_barang,
                'jml_permintaan' => $request->jml,
                'harga_barang' => $barang->harga,
                'total_barang' => $request->jml * $barang->harga,
                'ket' => $request->ket
            ]);
        }

        return response()->json(['success' => true]);
    }

    function checkoutKeranjang(Request $request)
    {
        $tutupPengadaan = 20;

        DB::beginTransaction();

        try {

            // if (now()->day > $tutupPengadaan) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Pengadaan telah ditutup per tanggal '.$tutupPengadaan.' setiap bulannya'
            //     ], 400);
            // }

            $user = auth()->user();

            // ambil role
            $unitArr = $user->roles->pluck('name')->toArray();

            // ✅ Validasi basic
            if (!$request->items || count($request->items) == 0) {
                return response()->json([
                    'message' => 'Item tidak boleh kosong'
                ], 422);
            }

            // ✅ Generate ID pengadaan (contoh: otomatis increment dari yang terakhir)
            $last = pengadaan::orderBy('id_pengadaan', 'desc')->lockForUpdate()->first();
            $newIdPengadaan = $last ? $last->id_pengadaan + 1 : 1;

            // buat pengadaan
            $pengadaan = pengadaan::create([
                'id_pengadaan' => $newIdPengadaan,
                'id_user' => $user->id,
                'unit' => json_encode($unitArr),
                'total' => $request->total,
                'tgl_pengadaan' => now()
            ]);

            // loop items dari AJAX
            foreach ($request->items as $item) {

                if (!isset($item['id_barang']) || !isset($item['jumlah'])) {
                    throw new \Exception('Format item tidak valid');
                }

                $barang = pengadaan_barang::find($item['id_barang']);

                if (!$barang) {
                    throw new \Exception('Barang tidak ditemukan ID: ' . $item['id_barang']);
                }

                pengadaan_detail::create([
                    'id_pengadaan' => $newIdPengadaan,
                    'id_barang' => $item['id_barang'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $barang->harga,
                    'satuan' => $barang->satuan,
                    'total' => $item['jumlah'] * $barang->harga,
                    'ket' => $item['ket'] ?? null
                ]);
            }

            // hapus terakhir (AMAN)
            pengadaan_keranjang::where('id_user', $user->id)->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Checkout berhasil'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal checkout',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    function hapusKeranjang($id)
    {
        $item = pengadaan_keranjang::find($id);

        if (!$item || $item->id_user != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan'
            ], 403);
        }

        $item->delete();

        return response()->json(['success' => true]);
    }

    public function updateKeranjang(Request $request, $id)
    {
        try {

            // VALIDASI
            $request->validate([
                'qty' => 'required|integer|min:1'
            ]);

            // AMBIL DATA
            $keranjang = pengadaan_keranjang::find($id);

            if (!$keranjang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data keranjang tidak ditemukan'
                ], 404);
            }

            // 🔒 OPTIONAL (RECOMMENDED) → pastikan milik user login
            if ($keranjang->id_user != auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak diizinkan'
                ], 403);
            }

            // HITUNG TOTAL BARU
            $qty = $request->qty;
            $total = $qty * $keranjang->harga_barang;

            // UPDATE
            $keranjang->update([
                'jml_permintaan' => $qty,
                'total_barang'   => $total
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Qty berhasil diupdate',
                'data' => [
                    'qty' => $qty,
                    'total' => $total
                ]
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    function dataBarang()
    {
        $barang = pengadaan_barang::orderBy('nama','asc')->whereNull('deleted_at')->get();

        $data = [
            'barang' => $barang,
        ];

        return response()->json($data, 200);
    }

    function loadMore()
    {
        $barang = pengadaan_barang::orderBy('nama','asc')->paginate(40);

        // print_r($barang);
        // die();

        return response()->json($barang, 200);
		// return view('pages.pengadaan.index',compact('barang'));
    }

    // function acbarang(Request $request)
    // {
    //     $getData = pengadaan_barang::select("nama")
    //             ->where("nama","LIKE","%{$request->caribarang}%")
    //             ->groupBy ('nama')
    //             ->get();

    //     foreach ($getData as $item)
    //     {
    //         $data[] = $item->nama;
    //     }

    //     return response()->json($data);
    // }

    function getacbarang(Request $request)
    {
        $barang = pengadaan_barang::where("nama","LIKE","%{$request->barang}%")->orderBy('nama','asc')->paginate(12);

        // print_r($barang);
        // die();

        return response()->json($barang, 200);
		// return view('pages.pengadaan.index',compact('barang'));
    }
}
