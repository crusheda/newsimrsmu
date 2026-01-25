<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\TelegramService;
use App\Models\perbaikan_it;

class botTelegramController extends Controller
{
    protected $tg;

    public function __construct(TelegramService $tg)
    {
        $this->tg = $tg;
    }

    public function webhook(Request $request)
    {
        $data = $request->all();
        \Log::info("Telegram Update:", $data);

        $adminId = env('TELEGRAM_ADMIN_CHAT_ID');

        // =======================================================
        // CALLBACK QUERY (user klik tombol)
        // =======================================================
        if (isset($data["callback_query"])) {

            $callbackId = $data["callback_query"]["id"];
            $chatId     = $data["callback_query"]["message"]["chat"]["id"];
            $action     = $data["callback_query"]["data"];

            // WAJIB → agar bot tidak freeze
            $this->tg->answerCallback($callbackId);

            if ($action === "lapor") {
                Cache::put("state_$chatId", "tanya_nama", 3600);
                $this->tg->sendMessage($chatId, "👤 *Nama lengkap Anda siapa?*");
            }

            if ($action === "pakai_foto") {
                Cache::put("state_$chatId", "tunggu_foto", 3600);
                $this->tg->sendMessage($chatId, "📷 Silakan kirim *foto pendukung*.");
            }

            if ($action === "tanpa_foto") {
                Cache::put("state_$chatId", "tanya_keluhan", 3600);
                $this->tg->sendMessage($chatId, "📝 *Silakan tuliskan keluhan IT Anda.*");
            }

            if ($action === "cek_status") {
                Cache::put("state_$chatId", "tanya_tiket", 3600);
                $this->tg->sendMessage($chatId, "Silakan masukkan *ID Tiket* Anda.\n\nContoh:\n`TIKET-20250101123000-123456`");
                return;
            }

            return response()->json(["ok" => true]);
        }

        // =======================================================
        // MESSAGE INPUT
        // =======================================================
        if (!isset($data["message"])) return response()->json(["ok" => true]);

        $chatId   = $data["message"]["chat"]["id"];
        $text     = trim($data["message"]["text"] ?? "");
        $username = $data["message"]["from"]["username"] ?? "Sobat";
        $state    = Cache::get("state_$chatId");

        // Jika user kirim foto saat tidak dalam proses laporan
        if (!$text && isset($data["message"]["photo"]) && !$state) {
            $this->tg->sendButtons(
                $chatId,
                "Halo @$username! Ada yang bisa kami bantu?",
                [
                    [
                        ["text" => "🔧 Buat Laporan IT", "callback_data" => "lapor"],
                        ["text" => "📄 Cek Status Pengaduan", "callback_data" => "cek_status"]
                    ]
                ]
            );

            return;
        }

        // ---------------------- NAMA ---------------------------
        if ($state === "tanya_nama") {
            Cache::put("nama_$chatId", $text, 3600);
            Cache::put("state_$chatId", "tanya_unit", 3600);

            $this->tg->sendMessage($chatId, "🏢 *Unit Anda dari mana?*");
            return;
        }

        // ---------------------- UNIT ---------------------------
        if ($state === "tanya_unit") {
            Cache::put("unit_$chatId", $text, 3600);
            Cache::put("state_$chatId", "tanya_foto", 3600);

            $this->tg->sendButtons(
                $chatId,
                "Apakah ingin mengirimkan *lampiran foto*?",
                [
                    [
                        ["text" => "📷 Ya", "callback_data" => "pakai_foto"],
                        ["text" => "❌ Tidak", "callback_data" => "tanpa_foto"],
                    ]
                ]
            );
            return;
        }

        // ---------------------- FOTO ---------------------------
        if ($state === "tunggu_foto") {

            if (!isset($data["message"]["photo"])) {
                $this->tg->sendMessage($chatId, "Silakan kirim foto terlebih dahulu.");
                return;
            }

            $fileId = end($data["message"]["photo"])["file_id"];

            Cache::put("foto_$chatId", $fileId, 3600);
            Cache::put("state_$chatId", "tanya_keluhan", 3600);

            $this->tg->sendMessage($chatId, "Foto diterima.\n\n📝 Sekarang tuliskan keluhan Anda.");
            return;
        }

        // -------------------- KELUHAN (FINAL) ------------------
        if ($state === "tanya_keluhan") {

            Cache::put("keluhan_$chatId", $text, 3600);

            $nama    = Cache::get("nama_$chatId");
            $unit    = Cache::get("unit_$chatId");
            $keluhan = Cache::get("keluhan_$chatId");
            $fotoId  = Cache::get("foto_$chatId");

            // 🔥 Generate Tiket
            $tiket = "TIKET-" . date("YmdHis") . "-" . $chatId;

            // 🔥 SIMPAN KE DATABASE
            perbaikan_it::create([
                "tiket_id"      => $tiket,
                "nama"          => $nama,
                "unit"          => $unit,
                "tgl_pengaduan" => now(),
                "ket_pengaduan" => $keluhan,
            ]);

            // 🔥 FORMAT ADMIN
            $pesan =
                "📢 *Laporan IT Baru*\n\n" .
                "🎫 *Tiket*: $tiket\n" .
                "💬 Chat ID: `$chatId`\n" .
                "👤 Username: @$username\n\n" .
                "👤 Nama : $nama\n" .
                "🏢 Unit : $unit\n" .
                "📅 Tanggal : " . date("Y-m-d") . "\n" .
                "⏰ Pukul : " . date("H:i:s") . "\n\n" .
                "📝 *Keluhan*: \n$keluhan";

            if ($fotoId)
                $this->tg->sendPhoto($adminId, $fotoId, $pesan);
            else
                $this->tg->sendMessage($adminId, $pesan);

            // 🔥 Konfirmasi ke user
            $this->tg->sendButtons(
                $chatId,
                "Terima kasih! Laporan Anda sudah tercatat.\n\n🎫 *Tiket*: *$tiket*\n\nSilakan cek status kapan saja.",
                [
                    [
                        ["text" => "🔍 Cek Status Pengaduan", "callback_data" => "cek_status"]
                    ]
                ]
            );

            // Reset
            Cache::forget("state_$chatId");
            Cache::forget("nama_$chatId");
            Cache::forget("unit_$chatId");
            Cache::forget("keluhan_$chatId");
            Cache::forget("foto_$chatId");

            return;
        }

        if ($state === "tanya_tiket") {

            $tiket = $text;

            $data = perbaikan_it::where('tiket_id', $tiket)->first();

            if (!$data) {
                $this->tg->sendMessage($chatId, "❌ *Tiket tidak ditemukan.*\nSilakan masukkan ID tiket yang benar.");
                return;
            }

            // Format status admin
            $status = $data->status ?? "Menunggu diproses";

            $pesan =
                "📄 *Status Pengaduan IT*\n\n" .
                "🎫 *Tiket*: $data->tiket_id\n" .
                "👤 Nama : $data->nama\n" .
                "🏢 Unit : $data->unit\n" .
                "📝 Keluhan :\n$data->ket_pengaduan\n\n" .
                "📌 *Status*: *$status*";

            $this->tg->sendMessage($chatId, $pesan);

            // Reset
            Cache::forget("state_$chatId");

            return;
        }

        // ---------------------- CHAT BIASA ---------------------
        $this->tg->sendButtons(
            $chatId,
            "Halo @$username! Ada yang bisa kami bantu?",
            [
                [
                    ["text" => "🔧 Buat Laporan IT", "callback_data" => "lapor"],
                    ["text" => "📄 Cek Status Pengaduan", "callback_data" => "cek_status"]
                ]
            ]
        );

        return response()->json(["ok" => true]);
    }
}
