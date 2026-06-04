<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class epinjam_list extends Model
{
    protected $table = 'epinjam_list';
    public $timestamps = true;
    use SoftDeletes;

    public function pinjam() // RELASI TABEL EPINJAM_LIST KE EPINJAM
    {
        return $this->belongsTo(epinjam::class, 'id_epinjam', 'id');
    }

    public function barang() // RELASI TABEL EPINJAM_LIST KE EPINJAM_BARANG
    {
        return $this->belongsTo(epinjam_barang::class, 'id_barang');
    }
}
