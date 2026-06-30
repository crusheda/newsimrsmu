<?php

namespace App\Http\Controllers\v4\IT\Perbaikan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\perbaikan_it;
use App\Models\perbaikan_it_kategori;
use App\Models\perbaikan_it_lampiran;
use App\Services\TelegramService;
use Carbon\Carbon;
use Auth, Redirect;

class TiketTelegramController extends Controller
{
    public function telegramWebhook(Request $request, TelegramService $telegram)
    {
        try {

            \Log::info('TELEGRAM UPDATE', $request->all());

            /*
            |--------------------------------------------------------------------------
            | HANDLE PRIVATE CHAT
            |--------------------------------------------------------------------------
            */

            $message = $request->input('message');

            if($message){

                // hanya private chat
                if(($message['chat']['type'] ?? null) == 'private'){
                    $chatId = $message['chat']['id'];
                    $text = trim($message['text'] ?? '');
                    /*

                    |--------------------------------------------------------------------------
                    | USER SEDANG CEK TIKET
                    |--------------------------------------------------------------------------
                    */
                    if(cache()->has("telegram_check_ticket_".$chatId)){
                        if(!preg_match('/^IT-\d+$/i', $text)){
                            $telegram->sendUser(
                                $chatId,
                                "❌ Format tiket tidak sesuai.\n\n".
                                "Gunakan format:\n".
                                "<b>IT-xxxxxxxxxxxx</b>"
                            );

                            return response()->json([
                                'ok'=>true
                            ]);
                        }

                        $tiket = perbaikan_it::where(
                            'tiket_id',
                            strtoupper($text)
                        )->first();

                        if(!$tiket){
                            $telegram->sendUser(
                                $chatId,
                                "❌ Tiket <b>{$text}</b> tidak ditemukan."
                            );

                            return response()->json([
                                'ok'=>true
                            ]);
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | STATUS TIKET
                        |--------------------------------------------------------------------------
                        */
                        if($tiket->tgl_tolak){
                            $status = "❌ DITOLAK";
                        }
                        elseif($tiket->tgl_selesai){
                            $status = "🎉 SELESAI";
                        }
                        elseif($tiket->tgl_kerjakan){
                            $status = "🔧 DIPROSES";
                        }
                        elseif($tiket->tgl_terima){
                            $status = "✅ DITERIMA";
                        }
                        else {
                            $status = "⏳ MENUNGGU";
                        }

                        $pesan =
                            "🚨 <b>STATUS TIKET IT</b>\n\n".
                            "🎫 Tiket:\n".
                            "<b>{$tiket->tiket_id}</b>\n\n".
                            "📌 Judul:\n".
                            "{$tiket->title}\n\n".
                            "📝 Keluhan:\n".
                            "{$tiket->ket_pengaduan}\n\n".
                            "━━━━━━━━━━━━━━\n".
                            "⏳ Status:\n".
                            "<b>{$status}</b>\n\n";

                        if($tiket->tgl_terima){
                            $pesan .=
                                "✅ Diterima:\n".
                                $tiket->tgl_terima->format('d/m/Y H:i').
                                " WIB\n".
                                "👨‍💻 {$tiket->nama_user_terima}\n\n";
                        }

                        if($tiket->tgl_kerjakan){
                            $pesan .=
                                "🔧 Dikerjakan:\n".
                                $tiket->tgl_kerjakan->format('d/m/Y H:i').
                                " WIB\n".
                                "👨‍💻 {$tiket->nama_user_kerjakan}\n\n";
                        }

                        if($tiket->tgl_selesai){
                            $pesan .=
                                "🎉 Selesai:\n".
                                $tiket->tgl_selesai->format('d/m/Y H:i').
                                " WIB\n".
                                "👨‍💻 {$tiket->nama_user_selesai}\n\n";
                        }

                        if($tiket->tgl_tolak){
                            $pesan .=
                                "❌ Ditolak:\n".
                                $tiket->tgl_tolak->format('d/m/Y H:i').
                                " WIB\n".
                                "👨‍💻 {$tiket->nama_user_tolak}\n\n";
                        }

                        $telegram->sendUser(
                            $chatId,
                            $pesan
                        );

                        // hapus mode cek
                        cache()->forget(
                            "telegram_check_ticket_".$chatId
                        );

                        return response()->json([
                            'ok'=>true
                        ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | START / MENU
                    |--------------------------------------------------------------------------
                    */
                    if($text == '/start'){
                        $telegram->sendUserWithButton(
                            $chatId,
                            "👋 <b>Selamat Datang</b>\n\n".
                            "Bot IT RS PKU Sukoharjo",
                            [
                                [
                                    [
                                        'text'=>'🎫 Cek Status Tiket',
                                        'callback_data'=>'cek_status'
                                    ]
                                ]
                            ]
                        );
                    }
                    return response()->json([
                        'ok'=>true
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | HANDLE PESAN BIASA
            |--------------------------------------------------------------------------
            */

            if($message){

                $threadId = $message['message_thread_id'] ?? null;

                if($threadId == $telegram->getTopicId()){

                    // hapus pesan user biasa di topic
                    if(!($message['from']['is_bot'] ?? false)){

                        try {

                            $telegram->deleteMessage(
                                $message['chat']['id'],
                                $message['message_id']
                            );

                            \Log::info('Pesan random dihapus',[
                                'text'=>$message['text'] ?? ''
                            ]);

                        } catch(\Throwable $e){

                            \Log::error('DELETE RANDOM ERROR',[
                                'message'=>$e->getMessage()
                            ]);
                        }
                    }
                }

                return response()->json([
                    'ok'=>true
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | HANDLE CALLBACK BUTTON
            |--------------------------------------------------------------------------
            */

            $callback = $request->input('callback_query');

            if(!$callback){

                return response()->json([
                    'ok'=>true
                ]);
            }

            $data = $callback['data'] ?? null;

            if(!$data){

                return response()->json([
                    'ok'=>true
                ]);
            }

            $message = $callback['message'] ?? null;

            if(!$message){

                return response()->json([
                    'ok'=>true
                ]);
            }

            $chatId = $message['chat']['id'];
            $messageId = $message['message_id'];

            $nama =
                ($callback['from']['first_name'] ?? '').
                ' '.
                ($callback['from']['last_name'] ?? '');

            /*
            |--------------------------------------------------------------------------
            | CALLBACK PRIVATE CHAT
            |--------------------------------------------------------------------------
            */

            if(($message['chat']['type'] ?? null) == 'private'){

                if($data == 'cek_status'){

                    $telegram->sendUser(
                        $chatId,
                        "🎫 <b>CEK STATUS TIKET</b>\n\n".
                        "Silahkan masukkan ID Tiket Anda.\n\n".
                        "Format:\n".
                        "<b>IT-xxxxxxxxxxxx</b>\n\n".
                        "Contoh:\n".
                        "<b>IT-260630194453</b>"
                    );

                    cache()->put(
                        "telegram_check_ticket_".$chatId,
                        true,
                        now()->addMinutes(5)
                    );

                    return response()->json([
                        'ok'=>true
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | FILTER TOPIC GROUP
            |--------------------------------------------------------------------------
            */

            if(
                ($message['message_thread_id'] ?? null)
                !=
                $telegram->getTopicId()
            ){

                return response()->json([
                    'ok'=>true
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | ACTION BUTTON
            |--------------------------------------------------------------------------
            */

            if(str_starts_with($data,'terima_')){

                $id = str_replace(
                    'terima_',
                    '',
                    $data
                );

                $this->terimaTelegram(
                    $id,
                    $nama,
                    $chatId,
                    $messageId,
                    $telegram
                );

            } elseif(str_starts_with($data,'kerjakan_')){

                $id = str_replace(
                    'kerjakan_',
                    '',
                    $data
                );

                $this->kerjakanTelegram(
                    $id,
                    $nama,
                    $chatId,
                    $messageId,
                    $telegram
                );

            } elseif(str_starts_with($data,'selesai_')){

                $id = str_replace(
                    'selesai_',
                    '',
                    $data
                );

                $this->selesaiTelegram(
                    $id,
                    $nama,
                    $chatId,
                    $messageId,
                    $telegram
                );

            } elseif(str_starts_with($data,'tolak_')){

                $id = str_replace(
                    'tolak_',
                    '',
                    $data
                );

                $this->tolakTelegram(
                    $id,
                    $nama,
                    $chatId,
                    $messageId,
                    $telegram
                );

            }

            /*
            |--------------------------------------------------------------------------
            | HILANGKAN LOADING BUTTON TELEGRAM
            |--------------------------------------------------------------------------
            */

            try {

                $telegram->answerCallbackQuery([
                    'callback_query_id'=>$callback['id'],
                    'text'=>'Status tiket diperbarui'
                ]);

            } catch(\Throwable $e){

                \Log::error('CALLBACK ERROR',[
                    'message'=>$e->getMessage()
                ]);
            }

            return response()->json([
                'ok'=>true
            ],200);

        } catch(\Throwable $e){

            \Log::error('TELEGRAM ERROR',[
                'message'=>$e->getMessage(),
                'line'=>$e->getLine(),
                'file'=>$e->getFile()
            ]);

            // supaya Telegram tidak retry terus
            return response()->json([
                'ok'=>true
            ],200);
        }
    }

    private function formatPesanTelegram($tiket, $status, $tambahan = '')
    {
        $pesan =
            "🚨 <b>TIKET</b> {$tiket->tiket_id}\n".
            "🕒 ".optional($tiket->created_at)->format('d/m/Y H:i')." WIB\n\n".

            "👤 <b>Pelapor :</b>\n".
            "{$tiket->nama}\n".
            "{$tiket->unit}\n\n".

            "📌 <b>Judul :</b>\n".
            "{$tiket->title}\n\n".

            "📋 <b>Kategori :</b>\n".
            "{$tiket->kategori->nama}\n\n".

            "📝 <b>Keluhan :</b>\n".
            "{$tiket->ket_pengaduan}\n\n".

            "━━━━━━━━━━━━━━\n".
            "⏳ <b>Status :</b>\n".
            "{$status}\n";

        if($tambahan){
            $pesan .= "\n".$tambahan;
        }

        return $pesan;
    }

    /**
     * Buat tiket baru
     */
    public function kirimTiket(Request $request, TelegramService $telegram)
    {
        $request->validate([
            'title' => 'required',
            'kategori' => 'required',
            'ket_pengaduan' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $getUser = User::with(['roles' => function($q){
                        $q->select('id','name','deskripsi');
                    }])
                    ->select(
                        'id',
                        'nip',
                        'name',
                        'nama',
                        'nama_lengkap',
                        'email'
                    )
                    ->where('id', $user->id)
                    ->whereNull('deleted_at')
                    ->whereNull('status')
                    ->first();

            $unit = $user->roles
                ->pluck('deskripsi')
                ->implode(',');

            $kategori = perbaikan_it_kategori::where('id', $request->kategori)->where('status', 1)->first();

            if (!$kategori) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Kategori tidak ditemukan',
                    ],
                    404,
                );
            }

            $kode = 'IT-' . now()->format('ymdHis');

            $nama = $user->nama_lengkap ?? ($user->nama ?? $user->name);

            $waktu = now();

            $tiket = perbaikan_it::create([
                'tiket_id' => $kode,
                'pegawai_id' => $user->id,
                'kategori_id' => $request->kategori,
                'title' => $request->title,
                'nama' => $nama,
                'unit' => $unit,
                'tgl_pengaduan' => $waktu,
                'ket_pengaduan' => $request->ket_pengaduan,
            ]);

            $pesan =
                    "🚨 <b>TIKET</b> {$kode}\n".
                    "🕒 ".$waktu->format('d/m/Y H:i')." WIB\n\n".
                    "👤 <b>Pelapor :</b>\n".
                    "{$nama}\n".
                    "{$unit}\n\n".
                    "📌 <b>Judul</b> : {$request->title}\n".
                    "📋 <b>Kategori</b> : {$kategori->nama}\n".
                    "📝 <b>Keluhan :</b>\n".
                    "{$request->ket_pengaduan}\n\n".
                    "⏳ <b>Status:</b>\n".
                    "Pending - Belum Diterima";

            try {
                // $response = $telegram->sendGroup($pesan);
                $response = $telegram->sendGroupWithButton(
                    $pesan,
                    $tiket->id,
                    [

                        [
                            [
                                'text'=>'✅ Terima',
                                'callback_data'=>"terima_{$tiket->id}"
                            ],

                            [
                                'text'=>'❌ Tolak',
                                'callback_data'=>"tolak_{$tiket->id}"
                            ]
                        ]

                    ]
                );

                $tiket->update([
                    'telegram_sent' => true,
                    'telegram_error' => null,

                    'telegram_chat_id' => $response->getChat()->getId(),
                    'telegram_message_id' => $response->getMessageId(),
                ]);
            } catch (\Exception $e) {
                $tiket->update([
                    'telegram_sent' => false,
                    'telegram_error' => $e->getMessage(),
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'telegram_sent' => $tiket->telegram_sent,
                'data' => 'Tiket berhasil dibuat',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    private function terimaTelegram($id, $petugas, $chatId, $messageId, TelegramService $telegram)
    {
        $tiket = perbaikan_it::findOrFail($id);

        $tiket->update([
            'tgl_terima'=>now(),
            'nama_user_terima'=>$petugas,
            'ket_terima'=>'Diterima melalui Telegram',
        ]);

        $pesan = $this->formatPesanTelegram(
            $tiket,
            'DITERIMA'
        );

        $telegram->editMessageButton(

            $chatId,
            $messageId,
            $pesan,

            [
                [
                    [
                        'text'=>'🔧 Kerjakan',
                        'callback_data'=>"kerjakan_{$tiket->id}"
                    ]
                ]
            ]
        );
    }

    private function kerjakanTelegram($id, $petugas, $chatId, $messageId, TelegramService $telegram)
    {
        $tiket = perbaikan_it::findOrFail($id);

        $tiket->update([
            'tgl_kerjakan'=>now(),
            'nama_user_kerjakan'=>$petugas,
            'ket_kerjakan'=>'Dikerjakan melalui Telegram',
        ]);

        $pesan = $this->formatPesanTelegram(
            $tiket,
            'DIKERJAKAN'
        );

        $telegram->editMessageButton(

            $chatId,
            $messageId,
            $pesan,

            [
                [
                    [
                        'text'=>'🎉 Selesai',
                        'callback_data'=>"selesai_{$tiket->id}"
                    ]
                ]
            ]

        );
    }

    private function selesaiTelegram($id, $petugas, $chatId, $messageId, TelegramService $telegram)
    {
        \Log::info('SELESAI CALLBACK', [
            'id'=>$id,
            'chatId'=>$chatId,
            'messageId'=>$messageId,
        ]);

        $tiket = perbaikan_it::with('kategori')
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Update status selesai
        |--------------------------------------------------------------------------
        */
        $tiket->update([
            'tgl_selesai'=>now(),
            'nama_user_selesai'=>$petugas,
            'ket_selesai'=>'Diselesaikan melalui Telegram',
        ]);

        // reload data terbaru
        $tiket->refresh();

        /*
        |--------------------------------------------------------------------------
        | Resume
        |--------------------------------------------------------------------------
        */
        $resume =
        "📌 <b>RESUME PENANGANAN IT</b>\n\n".

        "✅ Diterima\n".
        ($tiket->tgl_terima
            ? $tiket->tgl_terima->format('d/m/Y H:i')
            : '-') .
        " WIB\n".
        "👨‍💻 Oleh : ".($tiket->nama_user_terima ?? '-')."\n\n".

        "🔧 Dikerjakan\n".
        ($tiket->tgl_kerjakan
            ? $tiket->tgl_kerjakan->format('d/m/Y H:i')
            : '-') .
        " WIB\n".
        "👨‍💻 Oleh : ".($tiket->nama_user_kerjakan ?? '-')."\n\n".

        "🎉 Selesai\n".
        ($tiket->tgl_selesai
            ? $tiket->tgl_selesai->format('d/m/Y H:i')
            : '-') .
        " WIB\n".

        "👨‍💻 Oleh : ".($tiket->nama_user_selesai ?? '-');

        $pesan = $this->formatPesanTelegram(
            $tiket,
            'SELESAI',
            $resume
        );

        /*
        |--------------------------------------------------------------------------
        | Hapus pesan lama (status DIKERJAKAN)
        |--------------------------------------------------------------------------
        */
        try {
            $telegram->deleteMessage(
                $chatId,
                $messageId
            );
        } catch(\Throwable $e){
            \Log::warning(
                'DELETE TELEGRAM GAGAL',
                [
                    'error'=>$e->getMessage()
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Kirim pesan final
        |--------------------------------------------------------------------------
        */
        try {
            $response = $telegram->sendGroup(
                $pesan
            );
            if($response){
                $tiket->update([
                    'telegram_message_id'
                        =>
                    $response->getMessageId()
                ]);
            }
        } catch(\Throwable $e){
            \Log::error(
                'KIRIM RESUME TELEGRAM GAGAL',
                [
                    'error'=>$e->getMessage()
                ]
            );
        }
    }

    private function tolakTelegram($id, $petugas, $chatId, $messageId, TelegramService $telegram)
    {
        $tiket = perbaikan_it::findOrFail($id);

        $tiket->update([
            'tgl_tolak'=>now(),
            'nama_user_tolak'=>$petugas,
            'ket_tolak'=>'Ditolak melalui Telegram',
        ]);

        $tambahan =
            "❌ <b>ALASAN DITOLAK</b>\n".
            "{$tiket->ket_tolak}\n\n".

            "👨‍💻 <b>Ditolak Oleh :</b>\n".
            "{$petugas}\n\n".

            "🕒 <b>Waktu Tolak :</b>\n".
            $tiket->tgl_tolak->format('d/m/Y H:i').
            " WIB";

        $pesan = $this->formatPesanTelegram(
            $tiket,
            'DITOLAK',
            $tambahan
        );

        $telegram->editMessageButton(
            $chatId,
            $messageId,
            $pesan,
            [] // hapus semua tombol
        );

    }
}
