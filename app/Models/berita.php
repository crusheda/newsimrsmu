<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class berita extends Model
{
    use SoftDeletes;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'gambar',
        'gambar_lampiran_1',
        'gambar_lampiran_2',
        'gambar_lampiran_3',
        'gambar_lampiran_4',
        'gambar_lampiran_5',
        'ringkasan',
        'isi',
        'penulis',
        'is_published',
        'published_at',
        'views',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
