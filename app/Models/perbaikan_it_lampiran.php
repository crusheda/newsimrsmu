<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class perbaikan_it_lampiran extends Model
{
    // use HasFactory;

    protected $table = 'perbaikan_it_lampiran';
    public $timestamps = true;
    use SoftDeletes;

    protected $fillable=[
        'tiket_id',
        'pegawai_id',
        'title',
        'filename',
        'ket',
        'status'
    ];

    public function tiket()
    {
        return $this->belongsTo(
            perbaikan_it::class,
            'tiket_id',
            'tiket_id'
        );
    }
}
