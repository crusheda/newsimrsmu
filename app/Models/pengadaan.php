<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class pengadaan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pengadaan';
    protected $primaryKey = 'id_pengadaan';
    public $timestamps = true;

    protected $fillable = [
        'id_pengadaan',
        'id_user',
        'unit',
        'total',
        'tgl_pengadaan',
        'tgl_verif'
    ];

    // ================= RELASI =================

    // ke user
    public function user()
    {
        return $this->belongsTo(users::class, 'id_user');
    }

    // ke detail
    public function details()
    {
        return $this->hasMany(pengadaan_detail::class, 'id_pengadaan', 'id_pengadaan');
    }
}
