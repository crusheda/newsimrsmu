<?php

namespace App\Services;

use App\Models\perbaikan_ipsrs;
use App\Models\kepegawaian\jadwal;
use App\Models\kepegawaian\ref_jadwal_users;
use App\Models\struktur_organisasi;
use App\Models\epinjam;
use App\Models\model_has_roles;

class NotificationService
{
    public function get(): array
    {
        $user = auth()->user();

        if (!$user) {
            return [];
        }

        // START NOTIFIKASI E-PINJAM FOR - ADMIN
            $isExistEpinjam = 0;
            if ($user->can('epinjam')) {
                $isExistEpinjam = epinjam::where('status',1)->whereNull('deleted_at')->count();
            }
        // END NOTIFIKASI E-PINJAM FOR - ADMIN

        // ------------------------------------------------------------------------------------------------------------------

        // START NOTIFIKASI PERBAIKAN IPSRS FOR - ADMIN
            $isExistPerbaikanIpsrs = 0;
            if ($user->can('admin_perbaikan_ipsrs')) {
                $isExistPerbaikanIpsrs = perbaikan_ipsrs::whereNull('tgl_diterima')->whereNull('tgl_selesai')->whereNull('deleted_at')->count();
            }
        // END NOTIFIKASI PERBAIKAN IPSRS FOR - ADMIN

        // ------------------------------------------------------------------------------------------------------------------

        // START NOTIFIKASI VERIF JADWAL DINAS BAWAHAN
            $jabatan = struktur_organisasi::where('id_user', $user->id)
                        ->orderBy('updated_at','desc')
                        ->first();

            // if (!$jabatan) {
            //     return collect(); // Kosongkan hasil jika tidak ada jabatan
            // }
            if (!$jabatan) {
                return [
                    'isExistEpinjam' => $isExistEpinjam,
                    'isExistPerbaikanIpsrs' => $isExistPerbaikanIpsrs,
                    'countVerifJDBawahan' => 0,
                ];
            }

            $bawahanRoles = json_decode($jabatan->bawahan); // Contoh: ["14","93","94","95","55","56"]

            // 1. Pegawai yang punya role bawahan (user seperti 164)
            $pegawaiDenganRole = model_has_roles::whereIn('role_id', $bawahanRoles)
                                                ->pluck('model_id')
                                                ->unique();

            // 2. Pegawai penginput (pegawai_id dari referensi_jadwal_users) yang staf-nya mengandung pegawai bawahan
            $pegawaiPenginput = ref_jadwal_users::where(function ($query) use ($pegawaiDenganRole) {
                                                    foreach ($pegawaiDenganRole as $pegawaiId) {
                                                        $query->orWhereRaw("JSON_CONTAINS(staf, JSON_QUOTE(?))", [(string) $pegawaiId]);
                                                    }
                                                })
                                                ->pluck('pegawai_id')
                                                ->unique();

            // 3. Gabungkan keduanya — yang bisa input sendiri atau staf dari orang lain
            $finalPegawaiIds = $pegawaiDenganRole->merge($pegawaiPenginput)->unique();

            // 4. Ambil data jadwal dengan unit
            $countVerifJDBawahan = jadwal::join('users', 'users.id', '=', 'kepegawaian_jadwal.pegawai_id')
                ->select('kepegawaian_jadwal.*', 'users.nama as nama_pegawai')
                ->whereIn('kepegawaian_jadwal.pegawai_id', $finalPegawaiIds)
                ->where('kepegawaian_jadwal.progress',1)
                ->whereNull('kepegawaian_jadwal.deleted_at')
                ->count();
        // END NOTIFIKASI VERIF JADWAL DINAS BAWAHAN
        // ------------------------------------------------------------------------------------------------------------------

        return [
            'isExistEpinjam' => $isExistEpinjam,
            'isExistPerbaikanIpsrs' => $isExistPerbaikanIpsrs,
            'countVerifJDBawahan' => $countVerifJDBawahan,
        ];
    }
}
