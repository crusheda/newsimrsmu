<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoMeeting extends Model
{
    protected $fillable = [
        'created_by',
        'title',
        'room_name',
        'start_at',
        'end_at',
        'status'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
