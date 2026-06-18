<?php

namespace App\Models\kepegawaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class absensi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'kepegawaian_absensi';
    public $timestamps = true;

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai_id', 'id');
    }
}
