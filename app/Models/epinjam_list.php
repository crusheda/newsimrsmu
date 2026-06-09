<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class epinjam_list extends Model
{
    protected $table = 'epinjam_list';
    public $timestamps = true;
    use SoftDeletes;

    // SEMUA FIELD BOLEH DIISI
    protected $guarded = [];

    // FIELD TERTENTU SAJA YANG BOLEH DIISI
    // protected $fillable = [
    //     'id_epinjam',
    //     'id_barang',
    //     'jumlah',
    //     'tgl_rencana_kembali',
    //     'keterangan',
    //     'peruntukan',
    //     'status',
    // ];

    public function pinjam() // RELASI TABEL EPINJAM_LIST KE EPINJAM
    {
        return $this->belongsTo(epinjam::class, 'id_epinjam', 'id');
    }

    public function barang() // RELASI TABEL EPINJAM_LIST KE EPINJAM_BARANG
    {
        return $this->belongsTo(epinjam_barang::class, 'id_barang');
    }
}
