<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class chat_sessions extends Model
{
    protected $table = 'chat_sessions';
    public $timestamps = true;
    // use SoftDeletes;

    protected $fillable = [
        'phone',
        'state',
        'kategori_id',
        'last_active_at'
    ];
}
