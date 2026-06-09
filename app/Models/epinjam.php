<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class epinjam extends Model
{
    protected $table = 'epinjam';
    public $timestamps = true;
    use SoftDeletes;

    public function list() // RELASI TABEL EPINJAM KE EPINJAM_LIST
    {
        return $this->hasMany(epinjam_list::class, 'id_epinjam', 'id');
    }

    protected $guarded = [];
    // protected $fillable = [];
}

//  PENGGUNAAN QUERY RELASI
//      $show = epinjam::with('list.barang.kategori')->find(1);
//      $show->list->barang->kategori->nama;
