<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class epinjam_barang extends Model
{
    protected $table = 'epinjam_barang';
    public $timestamps = true;
    use SoftDeletes;

    protected $guarded = [];

    public function list() // RELASI TABEL EPINJAM_BARANG KE EPINJAM_LIST
    {
        return $this->hasMany(epinjam_list::class, 'id_barang', 'id');
    }

    public function kategori() // RELASI TABEL EPINJAM_BARANG KE EPINJAM_KATEGORI
    {
        return $this->belongsTo(epinjam_kategori::class, 'id_kategori', 'id');
    }

    public function asal() // RELASI TABEL EPINJAM_BARANG KE EPINJAM_ASAL
    {
        return $this->belongsTo(epinjam_asal::class, 'id_asal', 'id');
    }

    public function kondisi() // RELASI TABEL EPINJAM_BARANG KE REFERENSI (JENIS=15)
    {
        return $this->belongsTo(referensi::class, 'kondisi', 'queue')->where('ref_jenis', 15);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
