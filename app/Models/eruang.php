<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class eruang extends Model
{
    use HasFactory;
    protected $table = 'eruang';
    public $timestamps = true;
    use SoftDeletes;

    public function ruangan()
    {
        return $this->belongsTo(eruang_ref::class, 'id_ruangan', 'id');
    }

    protected $fillable = [
        'id_user',
        'id_ruangan',
        'agenda',
        'tgl',
        'tgl_mulai',
        'tgl_selesai',
        'jam_mulai',
        'jam_selesai',
        'ket',
        'gizi',
        'gizi_verif',
        'status_penolakan',
        'alasan_penolakan',
    ];
}
