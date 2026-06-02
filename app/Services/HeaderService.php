<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

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

        return [
            'id'    => $user->id,
            'nama'  => $nama,
            'email' => $user->email,
            'role'  => optional($user->roles->first())->name,
            'foto' => optional($user->foto)->filename
                    ? asset('storage/' . str_replace('public/', '', $user->foto->filename))
                    : asset('images/users/user-dummy-img.jpg'),
        ];
    }
}
