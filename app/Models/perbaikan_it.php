<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\perbaikan_it_kategori;

class perbaikan_it extends Model
{
    use HasFactory;
    protected $table = 'perbaikan_it';
    public $timestamps = true;
    use SoftDeletes;

    protected $casts = [
        'unit' => 'array',
    ];

    // protected $fillable = [
    //     'tiket_id',
    //     'title',
    //     'filename',
    //     'nama',
    //     'no_wa',
    //     'unit',
    //     'estimasi',
    //     'tgl_pengaduan',
    //     'ket_pengaduan'
    // ];

    protected $fillable = [
        'pegawai_id',
        'tiket_id',
        'kategori_id',
        'telegram_chat_id',
        'telegram_username',
        'title',
        'filename',
        'nama',
        'no_wa',
        'unit',
        'estimasi',
        'tgl_pengaduan',
        'ket_pengaduan',
        'tgl_terima',
        'tgl_kerjakan',
        'tgl_selesai',
        'tgl_tolak',
        'ket_terima',
        'ket_kerjakan',
        'ket_selesai',
        'ket_tolak',
        'nama_user_terima',
        'nama_user_kerjakan',
        'nama_user_selesai',
        'nama_user_tolak',
        'user_terima',
        'user_kerjakan',
        'user_selesai',
        'user_tolak',
        'telegram_sent',
        'telegram_error',
    ];

    public function kategori()
    {
        return $this->belongsTo(perbaikan_it_kategori::class, 'kategori_id');
    }

    public function lampiran()
    {
        return $this->hasMany(
            perbaikan_it_lampiran::class,
            'tiket_id',
            'tiket_id'
        );
    }
}
