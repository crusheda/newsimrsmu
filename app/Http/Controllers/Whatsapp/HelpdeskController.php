<?php

namespace App\Http\Controllers\Whatsapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\perbaikan_it;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Str;

class HelpdeskController extends Controller
{
    public function kirimTiketGroup(Request $request)
    {
        // generate tiket
        $tiket = 'IT-'.now()->format('YmdHis');

        // simpan DB
        $lapor = perbaikan_it::create([

            'tiket_id'       => $tiket,
            'title'          => $request->title,
            'nama'           => auth()->user()->name ?? $request->nama,
            'no_wa'          => $request->no_wa,
            'unit'           => $request->unit,
            'tgl_pengaduan'  => now(),
            'ket_pengaduan'  => $request->ket_pengaduan

        ]);

        // FORMAT PESAN DULU
        $pesan = "🚨 *TIKET PERBAIKAN IT BARU*
🎫 Tiket : *{$lapor->tiket_id}*

📌 Judul : _{$lapor->title}_
👤 Pelapor : _{$lapor->nama}_
🏥 Unit : _{$lapor->unit}_
🕒 Waktu : _".Carbon::parse($lapor->tgl_pengaduan)->format('d/m/Y H:i')." WIB_

📝 Keluhan :
> {$lapor->ket_pengaduan}";

        // kalau ada foto
        if($request->hasFile('filename')){

            // $path = $request->file('filename')->store('perbaikan_it','public');

            // $lapor->update([
            //     'filename'=>$path
            // ]);

            // Http::timeout(5)->post('http://127.0.0.1:3000/send-group-image',[
            //     'caption'=>$pesan,
            //     'image'=>asset('storage/'.$path)
            // ]);

        } else {

            $response = Http::timeout(5)->post('http://127.0.0.1:3000/send-group',[
                'number'=>$lapor->no_wa,
                'message'=>$pesan
            ]);

            if($response->failed()){
                return response()->json([
                    'status'=>false,
                    'message'=>'Tiket ID#'.$lapor->tiket_id.' diterima, tapi WA gagal terkirim. Pesan : '.$response->body()
                ],500);
            }
        }

        return response()->json([
            'status' => true,
            'data' => "Laporan berhasil dikirim"
        ], 200);
    }

    public function kirimTerimaTiket(Request $request,$id)
    {
        $tiket = perbaikan_it::findOrFail($id);

        $tiket->update([
            'tgl_terima'=>now(),
            'ket_terima'=>$request->ket_terima ?? "Tiket {$tiket->tiket_id} sudah diterima IT"
        ]);

        $petugas = 'Admin' ?? '-'; // auth()->user()->nama

        $pesan = "📣 Halo {$tiket->nama}
Tiket {$tiket->tiket_id} Sudah kami TERIMA ✅
Petugas: {$petugas}

Mohon ditunggu 🙏";

        $response = Http::timeout(5)->post('http://127.0.0.1:3000/send-personal',[
            'number'=>$tiket->no_wa,
            'message'=>$pesan
        ]);

        if($response->failed()){
            return response()->json([
                'status'=>false,
                'message'=>'Tiket ID#'.$tiket->tiket_id.' diterima, tapi WA gagal terkirim. Pesan : '.$response->body()
            ],500);
        }

        return response()->json([
            'status' => true,
            'data' => "Tiket berhasil diterima & WA terkirim"
        ], 200);
    }

    public function kirimKerjakanTiket(Request $request,$id)
    {
        $tiket = perbaikan_it::findOrFail($id);

        $tiket->update([
            'tgl_kerjakan'=>now(),
            'ket_kerjakan'=>$request->ket_kerjakan,
            'user_kerjakan'=>auth()->id()
        ]);

        $petugas = 'Admin' ?? '-'; // auth()->user()->nama

        $pesan = "🔧 Halo {$tiket->nama}
Tiket {$tiket->tiket_id} Sedang kami KERJAKAN 🚧
Petugas: {$petugas}

Mohon ditunggu 🙏";

        $response = Http::timeout(5)->post('http://127.0.0.1:3000/send-personal',[
            'number'=>$tiket->no_wa,
            'message'=>$pesan
        ]);

        if($response->failed()){
            return response()->json([
                'status'=>false,
                'message'=>'Tiket ID#'.$tiket->tiket_id.' dikerjakan, tapi WA gagal terkirim. Pesan : '.$response->body()
            ],500);
        }

        return response()->json([
            'status' => true,
            'data' => "Tiket berhasil dikerjakan & WA terkirim"
        ], 200);
    }

    public function kirimSelesaiTiket(Request $request,$id)
    {
        $tiket = perbaikan_it::findOrFail($id);

        $tiket->update([
            'tgl_selesai'=>now(),
            'ket_selesai'=>$request->ket_selesai,
            'user_selesai'=>auth()->id()
        ]);

        $petugas = 'Admin' ?? '-';

        $pesan = "✅ Halo {$tiket->nama}
Tiket {$tiket->tiket_id} Sudah kami SELESAIKAN 🎉
Petugas: {$petugas}

Selamat Beraktivitas Kembali.";

        $response = Http::timeout(5)->post('http://127.0.0.1:3000/send-personal',[
            'number'=>$tiket->no_wa,
            'message'=>$pesan
        ]);

        if($response->failed()){
            return response()->json([
                'status'=>false,
                'message'=>'Tiket ID#'.$tiket->tiket_id.' diselesaikan, tapi WA gagal terkirim. Pesan : '.$response->body()
            ],500);
        }

        return response()->json([
            'status' => true,
            'data' => "Tiket berhasil diselesaikan & WA terkirim"
        ], 200);
    }

    public function kirimTolakTiket(Request $request,$id)
    {
        $tiket = perbaikan_it::findOrFail($id);

        $tiket->update([
            'tgl_tolak'=>now(),
            'ket_tolak'=>$request->ket_tolak,
            'user_tolak'=>auth()->id()
        ]);

        $petugas = auth()->user()->nama ?? '-';

        $pesan = "❌ Halo {$tiket->nama}
Tiket {$tiket->tiket_id} Ditolak oleh petugas: {$petugas}

Alasan:
{$request->ket_tolak}

Silakan mengajukan kembali apabila diperlukan 🙏";

        $response = Http::timeout(5)->post('http://127.0.0.1:3000/send-personal',[
            'number'=>$tiket->no_wa,
            'message'=>$pesan
        ]);

        if($response->failed()){
            return response()->json([
                'status'=>false,
                'message'=>'Tiket ID#'.$tiket->tiket_id.' ditolak, tapi WA gagal terkirim. Pesan : '.$response->body()
            ],500);
        }

        return response()->json([
            'status' => true,
            'data' => "Tiket berhasil ditolak & WA terkirim"
        ], 200);
    }

    public function callback(Request $request)
    {
        $request->validate([
            'tiket_id' => 'required',
            'status'   => 'required|in:TERIMA,TOLAK',
            'petugas'  => 'required',
            'catatan'  => 'nullable',
        ]);

        $tiket = perbaikan_it::where('tiket_id',$request->tiket_id)->first();

        if(!$tiket){
            return response()->json([
                'status'=>false,
                'message'=>'Tiket tidak ditemukan'
            ],404);
        }

        $data = [];
        $now = Carbon::now()->format('d/m/Y H:i').' WIB';

        // kalau TERIMA → isi tgl_terima
        if($request->status == 'TERIMA'){
            $data['tgl_terima'] = now();
            $data['nama_user_terima'] = $request->petugas;
            if ($request->catatan) {
                $data['ket_terima'] = $request->catatan;
            }
        }

        // kalau TOLAK → isi tgl_tolak (optional)
        if($request->status == 'TOLAK'){
            $data['tgl_tolak'] = now();
            $data['nama_user_tolak'] = $request->petugas;
            if ($request->catatan) {
                $data['ket_tolak'] = $request->catatan;
            }
        }

        $tiket->update($data);

        return response()->json([
            'status'    => true,
            'message'   => "Tiket {$request->tiket_id} berhasil di {$request->status} oleh {$request->petugas} pada {$now}"
        ]);
    }

    private function prosesTerima($id, $ket = null)
    {
        $tiket = perbaikan_it::findOrFail($id);

        $tiket->update([
            'tgl_terima' => now(),
            'ket_terima' => $ket ?? "Tiket {$tiket->tiket_id} sudah diterima IT"
        ]);

        $petugas = 'Admin';

        $pesan = "📣 Halo {$tiket->nama}

Tiket {$tiket->tiket_id} Sudah DITERIMA otomatis oleh {$petugas} ✅

Mohon ditunggu 🙏";

        $response = Http::timeout(5)->post('http://127.0.0.1:3000/send-personal',[
            'number'=>$tiket->no_wa,
            'message'=>$pesan
        ]);

        return $response;
    }
}
