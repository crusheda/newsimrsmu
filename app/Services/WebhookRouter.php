<?php

namespace App\Services;
use App\Models\perbaikan_it as PerbaikanIt;
use App\Models\perbaikan_it_kategori as PerbaikanItKategori;
use App\Models\chat_sessions as ChatSession;
use Illuminate\Support\Str;
use Carbon\Carbon;

class WebhookRouter
{
    protected $whatsapp;

    public function __construct(WhatsAppService $whatsapp)
    {
        $this->whatsapp = $whatsapp;
    }

    public function process(array $data)
    {
        if (!isset($data['entry'][0]['changes'][0]['value']['messages'][0])) {
            return;
        }

        // if (($message['type'] ?? null) !== 'text' && ($message['type'] ?? null) !== 'interactive') {
        //     return;
        // }

        $profileName = $data['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name'] ?? 'User';
        $message = $data['entry'][0]['changes'][0]['value']['messages'][0];
        $from = $message['from'];

        // ==========================
        // Session + Welcome Message (KALO JADI DIPAKAI)
        // ==========================

        // $session = ChatSession::firstOrCreate(
        //     ['phone' => $from],
        //     ['state' => null, 'last_active_at' => now()]
        // );

        // Update last active time setiap ada interaksi
        // if (!$session->wasRecentlyCreated) {
        //     $session->update(['last_active_at' => now()]);
        // } else {
        //     // User baru → kirim welcome message
        //     $this->whatsapp->sendText($from, "👋 Halo! Selamat datang di layanan IT. Silakan pilih menu yang tersedia.");
        // }

        switch ($message['type']) {

            case 'text':
                $this->handleText($from, $message, $profileName);
                break;

            case 'interactive':
                $this->handleInteractive($from, $message, $profileName);
                break;
        }
    }

    /* ===============================
       TEXT HANDLER
    =============================== */

    private function handleText(string $from, array $message, string $profileName)
    {
        $text = trim($message['text']['body'] ?? '');

        if ($text === '') {
            return;
        }

        $session = ChatSession::where('phone', $from)->first();

        // -------------------------------
        // Kalau masih pilih kategori → tolak text + kirim list ulang
        // -------------------------------
        if ($session && $session->state === 'waiting_kategori') {

            // Kirim ulang list kategori
            $kategoriList = PerbaikanItKategori::where('status', 1)
                                ->orderBy('id','ASC')
                                ->get();

            $rows = [];
            foreach ($kategoriList as $kategori) {
                $rows[] = [
                    "id" => (string) $kategori->id,
                    "title" => substr(ucfirst($kategori->nama), 0, 24),
                    "description" => substr($kategori->deskripsi ?? '-', 0, 24)
                ];
            }

            // Tambahkan tombol batal
            $rows[] = [
                "id" => "0",
                "title" => "❌ Batal Buat Tiket",
                "description" => "Kembali ke menu utama"
            ];
            // \Log::info("Menampilkan list kategori untuk $from", ['kategori' => $kategoriList->pluck('nama')->toArray()]);

            $this->whatsapp->sendList(
                $from,
                "🚨 Silakan pilih kategori dari daftar yang tersedia.".
                "\n\n> Keterangan:".
                "\n- Mohon untuk tidak mengirim pesan bebas saat memilih kategori.".
                "\n- Pilih `Batal Buat Tiket` untuk kembali ke menu utama.",
                "Pilih Kategori",
                [
                    [
                        "title" => "Kategori IT",
                        "rows" => $rows
                    ]
                ]
            );

            \Log::info("Respon kirim list kategori ke $from", ['response' => $respon->json()]);

            return;
        }

        // -------------------------------
        // Kalau sedang isi keluhan → buat tiket
        // -------------------------------
        if ($session && $session->state === 'waiting_keluhan') {

            $kategoriId = $session->kategori_id;

            $session->delete();

            $this->createTicket($from, $profileName, $text, $kategoriId);

            return;
        }

        // -------------------------------
        // Kalau masih pilih status tiket → tolak text + kirim ulang list tiket
        // -------------------------------
        if ($session && $session->state === 'waiting_status_selection') {

            $tickets = PerbaikanIt::where('no_wa', $from)
                // ->whereNull('tgl_terima')
                // ->whereNull('tgl_kerjakan')
                // ->whereNull('tgl_selesai')
                ->whereNull('tgl_tolak')
                ->whereNull('deleted_at')
                ->orderByDesc('tgl_pengaduan')
                ->take(5)
                ->get();

            $rows = [];
            foreach ($tickets as $ticket) {

                // Ambil status dan emoji
                $status = $this->determineStatus($ticket);

                $emoji = match($status) {
                    'Menunggu Diproses' => '🟡',
                    'Sudah Diterima' => '⚪',
                    'Sedang Dikerjakan' => '🔵',
                    'Selesai' => '🟢',
                    'Ditolak' => '🔴',
                    default => '🟡'
                };

                $rows[] = [
                    "id" => $ticket->tiket_id,
                    "title" => $emoji . ' ' . substr($ticket->tiket_id, 0, 20), // title max 24 char WA
                    "description" => Str::limit($ticket->ket_pengaduan, 35, '...')
                                    . " | "
                                    . Carbon::parse($ticket->tgl_pengaduan)
                                        ->locale('id')
                                        ->translatedFormat('d M Y H:i') . ' WIB'
                ];
            }

            // Tambahkan tombol batal
            $rows[] = [
                "id" => "0",
                "title" => "❌ Batal Tracking",
                "description" => "Kembali ke menu utama"
            ];

            $this->whatsapp->sendList(
                $from,
                "🚨 Silakan pilih Status Tiket dari daftar yang tersedia.".
                "\n\n> Keterangan:".
                "\n- Mohon untuk tidak mengirim pesan bebas saat memilih status tiket.".
                "\n- Pilih `Batal Tracking` untuk kembali ke menu utama.\n\n".
                "Ketahui tanda lacak pada tiket Anda:\n".
                "🟡 Menunggu Diproses\n".
                "⚪ Sudah Diterima\n".
                "🔵 Sedang Dikerjakan\n".
                "🟢 Selesai\n".
                "🔴 Ditolak".
                "\n\nBerikut adalah 5 tiket terbaru Anda yang sedang diproses:",
                "Pilih Tiket Anda",
                [
                    [
                        "title" => "Daftar Tiket Aktif",
                        "rows" => $rows
                    ]
                ]
            );

            return;
        }

        // Default → menu utama
        $this->sendMainMenu($from, $profileName);
    }

    /* ===============================
       BUTTON HANDLER
    =============================== */

    private function handleInteractive(string $from, array $message, string $profileName)
    {
        $interactiveType = $message['interactive']['type'] ?? null;

        $buttonId = null;

        if ($interactiveType === 'button_reply') {
            $buttonId = $message['interactive']['button_reply']['id'] ?? null;
        }

        if ($interactiveType === 'list_reply') {
            $buttonId = $message['interactive']['list_reply']['id'] ?? null;
        }

        if ($buttonId === null) {
            return;
        }

        $session = ChatSession::where('phone', $from)->first();

        if ($buttonId === '0') {
            $session->delete();
            $this->sendMainMenu($from, $profileName);
            return;
        }

        // Kalau lagi pilih kategori
        if ($session && $session->state === 'waiting_kategori') {

            // Simpan kategori lalu lanjut ke isi keluhan
            $session->update([
                'state' => 'waiting_keluhan',
                'kategori_id' => $buttonId
            ]);

            $this->whatsapp->sendText(
                $from,
                "Silakan kirim detail keluhan Anda."
            );

            return;
        }

        if ($session && $session->state === 'waiting_status_selection') {

            $ticket = PerbaikanIt::where('tiket_id', $buttonId)
                ->where('no_wa', $from)
                ->first();

            if (!$ticket) {
                $this->whatsapp->sendText($from, "Tiket tidak ditemukan.");
                return;
            }

            $status = $this->determineStatus($ticket);

            if ($ticket->tgl_tolak) {
                $ket = $ticket->ket_tolak ? "Alasan: \n> {$ticket->ket_tolak}" : "Tidak ada keterangan tambahan.";
                $tgl_ket = Carbon::parse($ticket->tgl_tolak)->locale('id')->translatedFormat('d M Y H:i') . ' WIB';
                $ket .= "\n\nDitolak pada: {$tgl_ket} Oleh {$ticket->nama_user_tolak}";
            } else if ($ticket->tgl_selesai) {
                $ket = $ticket->ket_selesai ? "Keterangan: \n> {$ticket->ket_selesai}" : "Tidak ada keterangan tambahan.";
                $tgl_ket = Carbon::parse($ticket->tgl_selesai)->locale('id')->translatedFormat('d M Y H:i') . ' WIB';
                $ket .= "\n\nDiselesaikan pada: {$tgl_ket} Oleh {$ticket->nama_user_selesai}";
            } else if ($ticket->tgl_kerjakan) {
                $ket = $ticket->ket_kerjakan ? "Keterangan: \n> {$ticket->ket_kerjakan}" : "Tidak ada keterangan tambahan.";
                $tgl_ket = Carbon::parse($ticket->tgl_kerjakan)->locale('id')->translatedFormat('d M Y H:i') . ' WIB';
                $ket .= "\n\nMulai dikerjakan pada: {$tgl_ket} Oleh {$ticket->nama_user_kerjakan}";
            } else if ($ticket->tgl_terima) {
                $ket = $ticket->ket_terima ? "Keterangan: \n> {$ticket->ket_terima}" : "Tidak ada keterangan tambahan.";
                $tgl_ket = Carbon::parse($ticket->tgl_terima)->locale('id')->translatedFormat('d M Y H:i') . ' WIB';
                $ket .= "\n\nDiterima pada: {$tgl_ket} Oleh {$ticket->nama_user_terima}";
            } else {
                $ket = "Keterangan: \n> Tiket sedang menunggu diproses oleh Admin IT.";
            }

            $this->whatsapp->sendText(
                $from,
                "📄 *Detail Tiket* `{$ticket->tiket_id}`\n\n"
                . "Tgl.Pengaduan: " . Carbon::parse($ticket->tgl_pengaduan)->locale('id')->translatedFormat('d M Y H:i') ." WIB\n"
                . "Kategori: {$ticket->kategori->deskripsi}\n"
                . "Keluhan: {$ticket->ket_pengaduan}\n\n"
                . "Status: \n> *{$status}*\n\n"
                . "{$ket}"
            );

            $session->delete();

            $this->sendMainMenu($from, $profileName);

            return;
        }

        $this->handleButtonAction($from, $buttonId, $profileName);
    }

    private function handleButtonAction(string $from, string $buttonId, string $profileName)
    {
        switch ($buttonId) {

            case 'buat_tiket':

                ChatSession::updateOrCreate(
                    ['phone' => $from],
                    [
                        'state' => 'waiting_kategori',
                        'kategori_id' => null
                    ]
                );

                $kategoriList = PerbaikanItKategori::where('status', 1)
                                ->orderBy('id','ASC')
                                ->get();

                $rows = [];

                foreach ($kategoriList as $kategori) {
                    $rows[] = [
                        "id" => (string) $kategori->id, // penting string
                        "title" => ucfirst($kategori->nama),
                        "description" => $kategori->deskripsi ?? '-'
                    ];
                }

                // Tambahkan tombol batal
                $rows[] = [
                    "id" => "0",
                    "title" => "❌ Batal Buat Tiket",
                    "description" => "Kembali ke menu utama"
                ];

                $this->whatsapp->sendList(
                    $from,
                    "🚨 Silakan pilih kategori dari daftar yang tersedia.".
                    "\n\n> Keterangan:".
                    "\n- Mohon untuk tidak mengirim pesan bebas saat memilih kategori.".
                    "\n- Pilih `Batal Buat Tiket` untuk kembali ke menu utama.",
                    "Pilih Kategori",
                    [
                        [
                            "title" => "Kategori IT",
                            "rows" => $rows
                        ]
                    ]
                );

                break;

            case 'status_tiket':
                $tickets = PerbaikanIt::where('no_wa', $from)
                            // ->whereNull('tgl_terima')
                            // ->whereNull('tgl_kerjakan')
                            // ->whereNull('tgl_selesai')
                            ->whereNull('tgl_tolak')
                            ->whereNull('deleted_at')
                            ->orderByDesc('tgl_pengaduan')
                            ->take(5)
                            ->get();

                if ($tickets->isEmpty()) {
                    $this->whatsapp->sendText(
                        $from,
                        "Anda tidak memiliki tiket yang sedang diproses. Silakan buat tiket baru jika Anda memiliki masalah yang ingin dilaporkan."
                    );
                    return;
                }

                $rows = [];

                foreach ($tickets as $ticket) {

                    // Ambil status dan emoji
                    $status = $this->determineStatus($ticket);

                    $emoji = match($status) {
                        'Menunggu Diproses' => '🟡',
                        'Sudah Diterima' => '⚪',
                        'Sedang Dikerjakan' => '🔵',
                        'Selesai' => '🟢',
                        'Ditolak' => '🔴',
                        default => '🟡'
                    };

                    $rows[] = [
                        "id" => $ticket->tiket_id, // nanti dipakai untuk ambil detail
                        "title" => $emoji . ' ' . substr($ticket->tiket_id, 0, 20), // title max 24 char WA
                        "description" => Str::limit($ticket->ket_pengaduan, 35, '...')
                            . " | "
                            . Carbon::parse($ticket->tgl_pengaduan)->locale('id')->translatedFormat('d M Y H:i') . ' WIB'
                    ];
                }

                $rows[] = [
                    "id" => "0",
                    "title" => "❌ Batal Tracking",
                    "description" => "Kembali ke menu utama"
                ];

                ChatSession::updateOrCreate(
                    ['phone' => $from],
                    [
                        'state' => 'waiting_status_selection'
                    ]
                );

                \Log::info("User $from melihat status tiket. Tiket yang ditampilkan: " . implode(', ', $tickets->pluck('tiket_id')->toArray()));
                $this->whatsapp->sendList(
                    $from,
                    "Ketahui tanda lacak pada tiket Anda:\n".
                    "🟡 Menunggu Diproses\n".
                    "⚪ Sudah Diterima\n".
                    "🔵 Sedang Dikerjakan\n".
                    "🟢 Selesai\n".
                    "🔴 Ditolak\n\n".
                    "Berikut adalah 5 tiket terbaru Anda yang sedang diproses:",
                    "Pilih Tiket Anda",
                    [
                        [
                            "title" => "Daftar Tiket Aktif",
                            "rows" => $rows
                        ]
                    ]
                );

                break;

            default:
                $this->sendMainMenu($from, $profileName);
        }
    }

    // Metode untuk menentukan status tiket berdasarkan field tanggal
    private function determineStatus($ticket)
    {
        if ($ticket->tgl_tolak) {
            return "Ditolak";
        }

        if ($ticket->tgl_selesai) {
            return "Selesai";
        }

        if ($ticket->tgl_kerjakan) {
            return "Sedang Dikerjakan";
        }

        if ($ticket->tgl_terima) {
            return "Sudah Diterima";
        }

        return "Menunggu Diproses";
    }

    /* ===============================
       MENU
    =============================== */

    private function sendMainMenu(string $to, string $profileName)
    {
        $this->whatsapp->sendButtons(
            $to,
            "👋 Halo! {$profileName}\n\n"
            . "Terima kasih telah menghubungi Layanan IT Support.\n"
            . "Bot kami akan senantiasa membantu Anda 😊\n\n"
            . "Silakan pilih menu di bawah ini:",
            [
                ["id" => "buat_tiket", "title" => "Buat Tiket Layanan"],
                ["id" => "status_tiket", "title" => "Lacak Tiket Anda"],
            ]
        );
    }

    /* ===============================
       TICKET CREATION
    =============================== */
    private function createTicket($from, $profileName, $keluhan, $kategori)
    {
        $tiket = 'IT-' . now()->format('ymdHis');

        try {
            $this->whatsapp->sendText(
                $from,
                "Mohon tunggu sebentar, tiket Anda sedang kami buat..."
            );
        } catch (\Exception $e) {
            \Log::error("Gagal mengirim pesan saat pembuatan tiket: " . $e->getMessage());
        }

        $lapor = PerbaikanIt::create([
            'pegawai_id'     => null,
            'tiket_id'       => $tiket,
            'kategori_id'    => $kategori,
            'title'          => 'Laporan dari WhatsApp',
            'nama'           => $profileName,
            'no_wa'          => $from,
            'unit'           => '-',
            'tgl_pengaduan'  => now(),
            'ket_pengaduan'  => $keluhan,
            'filename'       => null
        ]);

        $this->whatsapp->sendText(
            $from,
            "Terima kasih {$profileName} telah melaporkan pengaduan anda.\n\n" .
            "Tiket {$tiket} anda telah kami terima.\n" .
            "Silakan menunggu informasi selanjutnya oleh Admin."
        );

        $this->sendMainMenu($from, $profileName);
    }
}
