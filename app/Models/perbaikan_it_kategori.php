<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class perbaikan_it_kategori extends Model
{
    protected $table = 'perbaikan_it_kategori';
    public $timestamps = true;
    use SoftDeletes;

    protected $fillable = [
        'nama',
        'deskripsi',
        'status'
    ];
}
