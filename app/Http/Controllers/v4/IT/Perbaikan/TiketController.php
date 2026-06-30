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

class TiketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kategori = perbaikan_it_kategori::where('status', 1)->get();

        if ($user->can('tiket_it') || $user->hasRole('karu-it')) {
            return view('pages.v4.it.pengajuan.perbaikan.index', compact('kategori'));
        } else {
            return redirect()->back();
        }
        // abort(403);
    }

    function table()
    {
        // hitung total tiket per status bulan ini dan bulan lalu, lalu hitung persentasenya
        $now = now();
        $startThisMonth = $now->copy()->startOfMonth();
        $startLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endLastMonth = $now->copy()->subMonth()->endOfMonth();

        $summary = [];

        /*
        |--------------------------------------------------------------------------
        | DITERIMA
        |--------------------------------------------------------------------------
        */
        $thisMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_terima')
            ->whereNull('tgl_kerjakan')
            ->whereNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startThisMonth, $now])
            ->count();

        $lastMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_terima')
            ->whereNull('tgl_kerjakan')
            ->whereNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->count();

        $summary['diterima'] = $this->calculatePercent($thisMonth, $lastMonth);


        /*
        |--------------------------------------------------------------------------
        | DIKERJAKAN
        |--------------------------------------------------------------------------
        */
        $thisMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_kerjakan')
            ->whereNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startThisMonth, $now])
            ->count();

        $lastMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_kerjakan')
            ->whereNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->count();

        $summary['dikerjakan'] = $this->calculatePercent($thisMonth, $lastMonth);


        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */
        $thisMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startThisMonth, $now])
            ->count();

        $lastMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_selesai')
            ->whereNull('tgl_tolak')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->count();

        $summary['selesai'] = $this->calculatePercent($thisMonth, $lastMonth);


        /*
        |--------------------------------------------------------------------------
        | DITOLAK
        |--------------------------------------------------------------------------
        */
        $thisMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_tolak')
            ->whereBetween('created_at', [$startThisMonth, $now])
            ->count();

        $lastMonth = perbaikan_it::whereNull('deleted_at')
            ->whereNotNull('tgl_tolak')
            ->whereBetween('created_at', [$startLastMonth, $endLastMonth])
            ->count();

        $summary['ditolak'] = $this->calculatePercent($thisMonth, $lastMonth);

        // ambil data tiket perbaikan IT dengan relasi user dan kategori, urutkan berdasarkan updated_at desc
        $show = perbaikan_it::with('kategori')
                            ->leftJoin('users', 'perbaikan_it.pegawai_id', '=', 'users.id')
                            // ->leftJoin('perbaikan_it_kategori', function($join) {
                            //     $join->on('perbaikan_it.kategori_id', '=', 'perbaikan_it_kategori.id')
                            //         ->whereNull('perbaikan_it_kategori.deleted_at')
                            //         ->where('perbaikan_it_kategori.status', 1);
                            // })
                            ->select(
                                'perbaikan_it.*',
                                'users.nama as nama_user',
                                'users.nama_lengkap as nama_lengkap_user',
                                // 'perbaikan_it_kategori.deskripsi as nama_kategori'
                            )
                            ->whereNull('perbaikan_it.deleted_at')
                            ->orderBy('perbaikan_it.updated_at', 'desc')
                            ->get();

        $allUnits = $show->pluck('unit')
        ->flatten()
        ->unique()
        ->values();

        $roles = Role::whereIn('name', $allUnits)
        ->pluck('deskripsi', 'name');

        // if ($show->isEmpty()) {
        //     return response()->json(['message' => 'Data Tiket Perbaikan IT tidak ditemukan'], 404);
        // }

        $data = [
            'summary' => $summary,
            'roles' => $roles,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    public function telegramWebhook(
        Request $request,
        TelegramService $telegram
    )
    {
        try {

            \Log::info('TELEGRAM UPDATE', $request->all());


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

            $message = $callback['message'];

            $chatId = $message['chat']['id'];

            $messageId = $message['message_id'];

            $nama =
                ($callback['from']['first_name'] ?? '').
                ' '.
                ($callback['from']['last_name'] ?? '');



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

            }


            elseif(str_starts_with($data,'kerjakan_')){


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

            }


            elseif(str_starts_with($data,'selesai_')){


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

            }


            elseif(str_starts_with($data,'tolak_')){


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



            try {

                $telegram->answerCallbackQuery([
                    'callback_query_id'=>$callback['id'],
                    'text'=>'Status tiket diperbarui'
                ]);

            } catch(\Throwable $e){

                \Log::error($e->getMessage());

            }



            return response()->json([
                'ok'=>true
            ],200);



        } catch(\Throwable $e){


            \Log::error('TELEGRAM ERROR',[
                'message'=>$e->getMessage(),
                'line'=>$e->getLine(),
                'file'=>$e->getFile(),
            ]);


            // WAJIB 200 supaya Telegram tidak retry
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

    /**
     * Terima tiket
     */
    public function terima(Request $request, $id, TelegramService $telegram)
    {
        $tiket = perbaikan_it::findOrFail($id);
        $petugas = auth()->user();
        $nama_petugas = $petugas->nama_lengkap ?? $petugas->nama ?? $petugas->name;

        $tiket->update([
            'tgl_terima' => now(),
            'user_terima' => auth()->id(),
            'nama_user_terima' => $nama_petugas,
            'ket_terima' => $request->ket_terima,
        ]);

        $telegram->sendGroup(
            "✅ <b>TIKET DITERIMA</b>\n\n".
            "🎫 <b>Tiket :</b>\n".
            "{$tiket->tiket_id}\n\n".
            "👨‍💻 <b>Petugas :</b>\n".
            "{$nama_petugas}\n\n".
            "📝 <b>Catatan :</b>\n".
            "{$request->ket_terima}\n\n".
            "⏳ <b>Status :</b>\n".
            "DITERIMA"
        );

        return response()->json([
            'status' => true,

            'data' => 'Tiket diterima',
        ]);
    }

    /**
     * Kerjakan tiket
     */
    public function kerjakan(Request $request, $id, TelegramService $telegram)
    {
        $tiket = perbaikan_it::findOrFail($id);
        $petugas = auth()->user();
        $nama_petugas = $petugas->nama_lengkap ?? $petugas->nama ?? $petugas->name;

        $tiket->update([
            'tgl_kerjakan' => now(),
            'user_kerjakan' => auth()->id(),
            'nama_user_kerjakan' => $nama_petugas,
            'ket_kerjakan' => $request->ket_kerjakan,
        ]);

        $telegram->sendGroup(
            "🔧 <b>TIKET DIKERJAKAN</b>\n\n".
            "🎫 <b>Tiket :</b>\n".
            "{$tiket->tiket_id}\n\n".
            "👨‍💻 <b>Teknisi :</b>\n".
            "{$nama_petugas}\n\n".
            "📝 <b>Catatan :</b>\n".
            "{$request->ket_kerjakan}\n\n".
            "⏳ <b>Status :</b>\n".
            "PROSES"
        );

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Selesai
     */
    public function selesai(Request $request, $id, TelegramService $telegram)
    {
        $tiket = perbaikan_it::findOrFail($id);
        $petugas = auth()->user();
        $nama_petugas = $petugas->nama_lengkap ?? $petugas->nama ?? $petugas->name;

        $tiket->update([
            'tgl_selesai' => now(),
            'user_selesai' => auth()->id(),
            'nama_user_selesai' => $nama_petugas,
            'ket_selesai' => $request->ket_selesai,
        ]);

        $telegram->sendGroup(
            "🎉 <b>TIKET SELESAI</b>\n\n".
            "🎫 <b>Tiket :</b>\n".
            "{$tiket->tiket_id}\n\n".
            "👨‍💻 <b>Teknisi :</b>\n".
            "{$nama_petugas}\n\n".
            "📝 <b>Penyelesaian :</b>\n".
            "{$request->ket_selesai}\n\n".
            "⏳ <b>Status :</b>\n".
            "SELESAI"
        );

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Tolak tiket
     */
    public function tolak(Request $request, $id, TelegramService $telegram)
    {
        $tiket = perbaikan_it::findOrFail($id);
        $petugas = auth()->user();
        $nama_petugas = $petugas->nama_lengkap ?? $petugas->nama ?? $petugas->name;

        $tiket->update([
            'tgl_tolak' => now(),
            'user_tolak' => auth()->id(),
            'nama_user_tolak' => $nama_petugas,
            'ket_tolak' => $request->ket_tolak,
        ]);

        $telegram->sendGroup(
            "❌ <b>TIKET DITOLAK</b>\n\n".
            "🎫 <b>Tiket :</b>\n".
            "{$tiket->tiket_id}\n\n".
            "👨‍💻 <b>Petugas :</b>\n".
            "{$nama_petugas}\n\n".
            "📝 <b>Alasan :</b>\n".
            "{$request->ket_tolak}"
        );

        return response()->json([
            'status' => true,
        ]);
    }

    // fungsi untuk menghitung persentase perubahan dari bulan lalu ke bulan ini
    private function calculatePercent($thisMonth, $lastMonth)
    {
        if ($lastMonth > 0) {
            $percent = (($thisMonth - $lastMonth) / $lastMonth) * 100;
        } else {
            $percent = $thisMonth > 0 ? 100 : 0;
        }

        return [
            'total' => $thisMonth,
            'percent' => round($percent, 2),
            'is_up' => $percent >= 0
        ];
    }

    // VIA TELEGRAM
    private function terimaTelegram(
        $id,
        $petugas,
        $chatId,
        $messageId,
        TelegramService $telegram
    )
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

    private function kerjakanTelegram(
        $id,
        $petugas,
        $chatId,
        $messageId,
        TelegramService $telegram
    )
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

    private function selesaiTelegram(
        $id,
        $petugas,
        $chatId,
        $messageId,
        TelegramService $telegram
    )
    {
        $tiket = perbaikan_it::findOrFail($id);

        $tiket->update([
            'tgl_selesai'=>now(),
            'nama_user_selesai'=>$petugas,
            'ket_selesai'=>'Diselesaikan melalui Telegram',
        ]);

        $tiket->refresh();

        $resume =
            "📌 <b>RESUME PENANGANAN IT</b>\n\n".

            "✅ Diterima\n".
            ($tiket->tgl_terima
                ? $tiket->tgl_terima->format('d/m/Y H:i')
                : '-') . " WIB\n".

            "👨‍💻 Oleh : {$tiket->nama_user_terima}\n\n".

            "🔧 Dikerjakan\n".
            ($tiket->tgl_kerjakan
                ? $tiket->tgl_kerjakan->format('d/m/Y H:i')
                : '-') . " WIB\n".

            "👨‍💻 Oleh : {$tiket->nama_user_kerjakan}\n\n".

            "🎉 Selesai\n".
            ($tiket->tgl_selesai
                ? $tiket->tgl_selesai->format('d/m/Y H:i')
                : '-') . " WIB\n\n".

            "👨‍💻 Oleh : {$tiket->nama_user_selesai}";

        $pesan = $this->formatPesanTelegram(
            $tiket,
            'SELESAI',
            $resume
        );

        $telegram->editMessageButton(

            $chatId,
            $messageId,
            $pesan,
            []
        );

    }

    private function tolakTelegram(
        $id,
        $petugas,
        $chatId,
        $messageId,
        TelegramService $telegram
    )
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
