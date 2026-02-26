<?php

namespace App\Http\Controllers\Whatsapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\perbaikan_it;
use App\Models\perbaikan_it_kategori;
use App\Models\perbaikan_it_lampiran;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Str;

class HelpdeskController extends Controller
{
    public function kirim($id, WhatsAppService $wa)
    {
        $tiket = perbaikan_it::with('kategori')->findOrFail($id);

        if (!$tiket->no_wa) {
            return response()->json(['error' => 'Nomor WA kosong'], 400);
        }

        $no = preg_replace('/[^0-9]/', '', $tiket->no_wa);
        if (substr($no, 0, 1) === '0') {
            $no = '62' . substr($no, 1);
        }

        $pesan =
            "📌 *TIKET IT*\n\n".
            "No Tiket : {$tiket->tiket_id}\n".
            "Nama : {$tiket->nama}\n".
            "Unit : {$tiket->unit}\n".
            "Kategori : {$tiket->kategori?->nama}\n".
            "Keluhan : {$tiket->title}\n".
            "Status : ".($tiket->tgl_selesai ? 'Selesai' : 'Diproses');

        // print_r($pesan); die();
        $response = $wa->sendText($no, $pesan);

        return response()->json([
            'success' => true,
            'wa_response' => $response->json()
        ]);
    }

    public function store(Request $request, WhatsAppService $wa)
    {
        $user = Auth::user();
        $no_wa = $user->no_hp;

        if (!$no_wa) {
            return response()->json(['error' => 'Nomor WA pengguna tidak ditemukan, silakan melengkapi profil dibagian no.HP'], 400);
        }

        $tiket = perbaikan_it::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        $no = preg_replace('/[^0-9]/', '', $no_wa);
        if (substr($no, 0, 1) === '0') {
            $no = '62' . substr($no, 1);
        }

        $pesan =
            "📌 *TIKET IT BERHASIL DIBUAT*\n\n".
            "No Tiket : {$tiket->tiket_id}\n".
            "Nama : {$tiket->nama}\n".
            "Unit : {$tiket->unit}\n".
            "Kategori : {$tiket->kategori->nama}\n".
            "Keluhan : {$tiket->title}\n\n".
            "Tim IT akan segera memproses."
        ;

        $response = $wa->sendText($no, $pesan);

        return response()->json(['success' => true]);
    }

    public function kirimTiket(Request $request, WhatsAppService $wa)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'kategori' => 'required|exists:perbaikan_it_kategori,id',
            'ket_pengaduan' => 'required|string'
        ]);

        $no_wa = optional(auth()->user())->no_hp;

        if (!$no_wa) {
            return response()->json(['error' => 'Nomor WA pengguna tidak ditemukan, silakan melengkapi profil dibagian no.HP'], 400);
        }

        $no = preg_replace('/[^0-9]/', '', $no_wa);
        if (substr($no, 0, 1) === '0') {
            $no = '62' . substr($no, 1);
        }

        // generate tiket dulu (belum simpan DB)
        $tiket = 'IT-'.now()->format('ymdHis');

        $getKategori = perbaikan_it_kategori::where('id', $request->kategori)->where('status', 1)->first();
        if(!$getKategori){
            return response()->json([
                'status'=>false,
                'message'=>'Mohon maaf, Kategori tidak ditemukan di Database'
            ],404);
        }

        $waktu = now();

        $nama_push = optional(auth()->user())->nama_lengkap
                        ?? optional(auth()->user())->nama
                        ?? optional(auth()->user())->name
                        ?? $request->nama;

        $roles = auth()->user()
            ? auth()->user()->getRoleNames()->toArray()
            : [];

        $unit_push_wa = !empty($roles)
            ? implode(', ', $roles)
            : $request->unit;

        $unit_push_db = !empty($roles)
            ? json_encode($roles)
            : json_encode([$request->unit]);

        // FORMAT PESAN
        $pesan = "🚨 *TIKET PERBAIKAN IT BARU*
🎫 Tiket : *{$tiket}*

📌 Judul : _{$request->title}_
📋 Kategori : _{$getKategori->deskripsi}_
👤 Pelapor : _{$nama_push}_
🏥 Unit : _{$unit_push_wa}_
🕒 Waktu : _".\Carbon\Carbon::parse($waktu)->format('d/m/Y H:i')." WIB_

📝 Keluhan :
> {$request->ket_pengaduan}";

        // =============================
        // 3️⃣ SIMPAN KE DATABASE
        // =============================

        $lapor = perbaikan_it::create([
            'pegawai_id'     => auth()->id() ?? null,
            'tiket_id'       => $tiket,
            'kategori_id'    => $request->kategori,
            'title'          => $request->title,
            'nama'           => $nama_push,
            'no_wa'          => $no,
            'unit'           => $unit_push_db,
            'tgl_pengaduan'  => $waktu,
            'ket_pengaduan'  => $request->ket_pengaduan,
            'filename'       => $path ?? null
        ]);

        return response()->json([
            'status' => true,
            'data'   => "Tiket dan notifikasi whatsapp berhasil dikirim & tersimpan di database"
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
