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

        return [
            'id'    => $user->id,
            'nama'  => $user->nama,
            'email' => $user->email,
            'role'  => optional($user->roles->first())->name,
            'foto' => optional($user->foto)->filename
                ? asset('storage/' . $user->foto->filename)
                : asset('images/users/user-dummy-img.jpg'),
        ];
    }
}
