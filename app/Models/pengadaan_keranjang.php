<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class pengadaan_keranjang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pengadaan_keranjang';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_barang',
        'jml_permintaan',
        'harga_barang',
        'total_barang',
        'ket'
    ];
}
