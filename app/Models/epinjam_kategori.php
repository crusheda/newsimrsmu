<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class epinjam_kategori extends Model
{
    protected $table = 'epinjam_kategori';
    public $timestamps = true;
    use SoftDeletes;

    protected $guarded = [];

    public function barang() // RELASI TABEL EPINJAM_KATEGORI KE EPINJAM_BARANG
    {
        return $this->hasMany(epinjam_barang::class, 'id_kategori', 'id');
    }
}
