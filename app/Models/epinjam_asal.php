<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class epinjam_asal extends Model
{
    protected $table = 'epinjam_asal';
    public $timestamps = true;
    use SoftDeletes;

    public function barang() // RELASI TABEL EPINJAM_KATEGORI KE EPINJAM_BARANG
    {
        return $this->hasMany(epinjam_barang::class, 'id_asal', 'id');
    }
}
