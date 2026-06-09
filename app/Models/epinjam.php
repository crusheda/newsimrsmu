<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class epinjam extends Model
{
    protected $table = 'epinjam';
    public $timestamps = true;
    use SoftDeletes;

    protected $guarded = [];

    public function list() // RELASI TABEL EPINJAM KE EPINJAM_LIST
    {
        return $this->hasMany(epinjam_list::class, 'id_epinjam', 'id');
    }

    public function userPinjam()
    {
        return $this->belongsTo(User::class, 'user_pinjam', 'id');
    }

    public function userAdminPinjam()
    {
        return $this->belongsTo(User::class, 'user_admin_pinjam', 'id');
    }

    public function userKembali()
    {
        return $this->belongsTo(User::class, 'user_kembali', 'id');
    }

    public function userAdminKembali()
    {
        return $this->belongsTo(User::class, 'user_admin_kembali', 'id');
    }

    // protected $fillable = [];
}

//  PENGGUNAAN QUERY RELASI
//      $show = epinjam::with('list.barang.kategori')->find(1);
//      $show->list->barang->kategori->nama;
