<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class users_foto extends Model
{
    use HasFactory;
    protected $table = 'users_foto';
    protected $fillable = ['user_id', 'filename'];
    public $timestamps = true;
    use SoftDeletes;
}
