<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class pengadaan_detail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pengadaan_detail';
    public $timestamps = true;

    protected $fillable = [
        'id_pengadaan',
        'id_barang',
        'jumlah',
        'harga',
        'satuan',
        'total',
        'ket',
        'title',
        'filename'
    ];

    // ================= RELASI =================

    // ke pengadaan
    public function pengadaan()
    {
        return $this->belongsTo(pengadaan::class, 'id_pengadaan', 'id_pengadaan');
    }

    // ke barang
    public function barang()
    {
        return $this->belongsTo(pengadaan_barang::class, 'id_barang');
    }
}
