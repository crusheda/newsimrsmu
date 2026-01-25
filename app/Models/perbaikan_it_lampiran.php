<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class perbaikan_it_lampiran extends Model
{
    use HasFactory;
    protected $table = 'perbaikan_it_lampiran';
    public $timestamps = true;
    use SoftDeletes;
}
