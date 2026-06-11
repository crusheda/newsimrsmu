<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HeaderService
{
    public function get(): ?array
    {
        if (! auth()->check()) {
            return null;
        }

        $user = auth()->user();

        if (! $user) {
            return null;
        }

        $user = auth()->user()->load([
            'foto',
            'roles',
        ]);

        if ($user->nama_lengkap) {
            $nama = $user->nama_lengkap;
        } elseif ($user->nama) {
            $nama = $user->nama;
        } else {
            $nama = $user->name;
        }

        $panggilan = $this->getPanggilan(
            $user->tgl_lahir,
            $user->jns_kelamin,
            $user->status_kawin
        );

        $time = Carbon::now()->isoFormat('H');
        // PENGHITUNGAN WAKTU PAGI / SIANG / SORE / MALAM
        if ($time < "10") {
            $waktu = "Pagi";
        } else {
            if ($time >= "10" && $time < "15") {
                $waktu = "Siang";
            } else {
                if ($time >= "15" && $time < "19") {
                    $waktu = "Sore";
                } else {
                    if ($time >= "19") {
                        $waktu = "Malam";
                    }
                }
            }
        }

        return [
            'id'        => $user->id,
            'waktu'     => $waktu,
            'nama'      => $nama,
            'nama_full' => $panggilan . ' ' . $nama,
            'email'     => $user->email,
            'role'      => optional($user->roles->first())->name,
            'foto'      => optional($user->foto)->filename
                            ? asset('storage/' . str_replace('public/', '', $user->foto->filename))
                            : asset('images/users/user-dummy-img.jpg'),
        ];
    }

    private function getPanggilan($tglLahir, $jenisKelamin, $statusKawin): string
    {
        if (!$tglLahir) {
            return '';
        }

        $umur = Carbon::parse($tglLahir)->age;

        // Usia 50 tahun ke atas
        if ($umur >= 50) {
            return $jenisKelamin === 'PEREMPUAN'
                ? 'Ibu'
                : 'Bp.';
        }

        // Usia 35 - 49 tahun
        if ($umur >= 35) {
            return $jenisKelamin === 'PEREMPUAN'
                ? ($statusKawin === 'BELUM' ? 'Nn.' : 'Ny.')
                : 'Tn.';
        }

        // Usia di bawah 35 tahun
        if ($jenisKelamin === 'PEREMPUAN') {
            return $statusKawin === 'BELUM'
                ? 'Nn.'
                : 'Ny.';
        } else {
            return $statusKawin === 'BELUM'
                ? 'Sdr.'
                : 'Tn.';
        }

        return 'Sdr.';
    }
}
