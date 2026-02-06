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
        $tiket = 'IT-'.now()->format('ymdHis');

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

            $response = Http::timeout(5)->post(config('services.wa.url').'/send-group',[
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

        $pesan = "📣 Halo {$tiket->nama}\nTiket `{$tiket->tiket_id}` Sudah kami TERIMA ✅\nPetugas: {$petugas}\n\nCatatan:\n> {$request->ket_terima}\n\nMohon ditunggu 🙏";

        $response = Http::timeout(5)->post(config('services.wa.url').'/send-personal',[
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

        $pesan = "🔧 Halo {$tiket->nama}\nTiket `{$tiket->tiket_id}` Sedang kami KERJAKAN 🚧\nPetugas: {$petugas}\n\nCatatan Pengerjaan:\n> {$request->ket_kerjakan}\n\nMohon ditunggu 🙏";

        $response = Http::timeout(5)->post(config('services.wa.url').'/send-personal',[
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

        $pesan = "✅ Halo {$tiket->nama}\nTiket `{$tiket->tiket_id}` Sudah kami SELESAIKAN 🎉\nPetugas: {$petugas}\n\nCatatan Penyelesaian:\n> {$ket_selesai}\n\nSelamat Beraktivitas Kembali.";

        $response = Http::timeout(5)->post(config('services.wa.url').'/send-personal',[
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

        $pesan = "❌ Halo {$tiket->nama}\nTiket `{$tiket->tiket_id}` Ditolak oleh petugas: {$petugas}\n\nAlasan Penolakan:\n{$request->ket_tolak}\n\nSilakan mengajukan kembali apabila diperlukan 🙏";

        $response = Http::timeout(5)->post(config('services.wa.url').'/send-personal',[
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
                'message'=>'Tiket tidak ditemukan / telah terhapus di Database'
            ],404);
        }

        if($tiket->tgl_terima){
            $tglterima = Carbon::parse($tiket->tgl_terima)->format('d/m/Y H:i');
            return response()->json([
                'status'=>false,
                'message'=>"Tiket {$request->tiket_id} sudah DITERIMA sebelumnya oleh {$tiket->nama_user_terima} pada {$tglterima} WIB"
            ],422);
        }

        if($tiket->tgl_tolak){
            $tgltolak = Carbon::parse($tiket->tgl_tolak)->format('d/m/Y H:i');
            return response()->json([
                'status'=>false,
                'message'=>"Tiket {$request->tiket_id} sudah DITOLAK sebelumnya oleh {$tiket->nama_user_tolak} pada {$tgltolak} WIB"
            ],422);
        }

        $data = [];
        $now = Carbon::now()->format('d/m/Y H:i').' WIB';

        // kalau TERIMA → isi tgl_terima
        if($request->status == 'TERIMA'){
            $data['tgl_terima'] = now();
            $data['nama_user_terima'] = $request->petugas;
            $data['ket_terima'] = $request->catatan;
            $pesan = "📣 Halo {$tiket->nama}\nTiket `{$tiket->tiket_id}` telah kami TERIMA ✅\nPetugas: {$request->petugas}\n\nCatatan Penerimaan:\n> {$request->catatan}\n\nMohon ditunggu 🙏";
        }

        // kalau TOLAK → isi tgl_tolak (optional)
        if($request->status == 'TOLAK'){
            $data['tgl_tolak'] = now();
            $data['nama_user_tolak'] = $request->petugas;
            $data['ket_tolak'] = $request->catatan;
            $pesan = "❗ Halo {$tiket->nama}\nTiket `{$tiket->tiket_id}` DITOLAK ❌\nPetugas: {$request->petugas}\n\Alasan Penolakan:\n> {$request->catatan}\n\nSilakan ajukan kembali bila diperlukan 🙏";
        }

        if ($tiket->no_wa) {
            try{
                Http::timeout(10)->post(config('services.wa.url').'/send-personal',[
                    'number'=>$tiket->no_wa,
                    'message'=>$pesan
                ]);
            }catch(\Exception $e){
                return response()->json([
                    'status'=>false,
                    'message'=>"Tiket {$request->tiket_id} sudah DITERIMA sebelumnya oleh {$tiket->nama_user_terima} pada {$tglterima} WIB"
                ],422);
            }
        }

        $tiket->update($data);

        return response()->json([
            'status'    => true,
            'message'   => "Tiket {$request->tiket_id} berhasil di {$request->status} oleh {$request->petugas} pada {$now}"
        ]);
    }
}
