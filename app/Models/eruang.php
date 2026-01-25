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
}
