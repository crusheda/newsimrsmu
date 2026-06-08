<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class epinjam_barang extends Model
{
    protected $table = 'epinjam_barang';
    public $timestamps = true;
    use SoftDeletes;

    public function kategori() // RELASI TABEL EPINJAM_BARANG KE EPINJAM_KATEGORI
    {
        return $this->belongsTo(epinjam_kategori::class, 'id_kategori', 'id');
    }

    public function asal() // RELASI TABEL EPINJAM_BARANG KE EPINJAM_ASAL
    {
        return $this->belongsTo(epinjam_asal::class, 'id_asal', 'id');
    }
}
