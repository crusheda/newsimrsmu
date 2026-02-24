<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class perbaikan_it extends Model
{
    use HasFactory;
    protected $table = 'perbaikan_it';
    public $timestamps = true;
    use SoftDeletes;

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
    ];
}
