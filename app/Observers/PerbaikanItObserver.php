<?php

namespace App\Observers;

use App\Models\perbaikan_it;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

class PerbaikanItObserver
{
    /**
     * Tambah Worker Queue send whatsapp message untuk mengirim notifikasi WA saat tiket dibuat
     */
    // SendWhatsAppNotification::dispatch($tiket);

    /**
     * Saat tiket dibuat
     */
    public function created(perbaikan_it $tiket): void
    {
        if (!$tiket->no_wa) return;

        try {

            $no = $this->formatNomor($tiket->no_wa);
            $kategori = optional($tiket->kategori)->deskripsi ?? '-';

            $message =
                "🚨 *TIKET PERBAIKAN IT*\n".
                "🎫 Tiket : *{$tiket->tiket_id}*\n\n".
                "📌 Judul : _{$tiket->title}_\n".
                "📋 Kategori : _{$kategori}_\n".
                "👤 Pelapor : _{$tiket->nama}_\n".
                "🏥 Unit : _{$tiket->unit}_\n".
                "🕒 Waktu : _".\Carbon\Carbon::parse($tiket->tgl_pengaduan)->format('d/m/Y H:i')." WIB_\n\n".
                "📝 Keluhan :\n".
                "{$tiket->ket_pengaduan}";

            $response = app(WhatsAppService::class)->sendText($no, $message);

            if ($response->successful()) {

                $tiket->updateQuietly([
                    'wa_sent' => true,
                    'wa_error' => null
                ]);

            } else {

                $tiket->updateQuietly([
                    'wa_sent' => false,
                    'wa_error' => $response->json('error.message') ?? $response->body()
                ]);
            }

        } catch (\Throwable $e) {

            Log::error('WA Created Error: '.$e->getMessage());

            $tiket->updateQuietly([
                'wa_sent' => false,
                'wa_error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Saat tiket diupdate
     */
    public function updated(perbaikan_it $tiket): void
    {
        if (!$tiket->no_wa) return;

        $no = $this->formatNomor($tiket->no_wa);

        try {

            // ✅ Saat diterima
            if ($tiket->isDirty('tgl_terima') && $tiket->tgl_terima != null) {

                app(WhatsAppService::class)->sendText(
                    $no,
                    "📥 *TIKET DITERIMA*\n\n".
                    "No Tiket : {$tiket->tiket_id}\n".
                    "Diterima oleh : {$tiket->nama_user_terima}\n".
                    "Keterangan : {$tiket->ket_terima}"
                );
            }

            // 🔧 Saat mulai dikerjakan
            if ($tiket->isDirty('tgl_kerjakan') && $tiket->tgl_kerjakan != null) {

                app(WhatsAppService::class)->sendText(
                    $no,
                    "🔧 *TIKET DIKERJAKAN*\n\n".
                    "No Tiket : {$tiket->tiket_id}\n".
                    "Dikerjakan oleh : {$tiket->nama_user_kerjakan}\n".
                    "Keterangan : {$tiket->ket_kerjakan}"
                );
            }

            // ✅ Saat selesai
            if ($tiket->isDirty('tgl_selesai') && $tiket->tgl_selesai != null) {

                app(WhatsAppService::class)->sendText(
                    $no,
                    "✅ *TIKET SELESAI*\n\n".
                    "No Tiket : {$tiket->tiket_id}\n".
                    "Diselesaikan oleh : {$tiket->nama_user_selesai}\n".
                    "Keterangan : {$tiket->ket_selesai}"
                );
            }

            // ❌ Saat ditolak
            if ($tiket->isDirty('tgl_tolak') && $tiket->tgl_tolak != null) {

                app(WhatsAppService::class)->sendText(
                    $no,
                    "❌ *TIKET DITOLAK*\n\n".
                    "No Tiket : {$tiket->tiket_id}\n".
                    "Ditolak oleh : {$tiket->nama_user_tolak}\n".
                    "Alasan : {$tiket->ket_tolak}"
                );
            }

        } catch (\Exception $e) {
            Log::error('WA Update Error: '.$e->getMessage());
        }
    }

    /**
     * Format nomor WA ke 62
     */
    private function formatNomor($no)
    {
        $no = preg_replace('/[^0-9]/', '', $no);

        if (substr($no, 0, 1) === '0') {
            $no = '62' . substr($no, 1);
        }

        return $no;
    }

    /**
     * Handle the perbaikan_it "deleted" event.
     */
    public function deleted(perbaikan_it $tiket): void
    {
        //
    }

    /**
     * Handle the perbaikan_it "restored" event.
     */
    public function restored(perbaikan_it $tiket): void
    {
        //
    }

    /**
     * Handle the perbaikan_it "force deleted" event.
     */
    public function forceDeleted(perbaikan_it $tiket): void
    {
        //
    }
}
