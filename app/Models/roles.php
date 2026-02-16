<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class roles extends Role
{
    use HasFactory, Loggable;

    protected $table = 'roles';
    public $timestamps = true;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'model_has_roles',
            'role_id',
            'model_id'
        );
    }
}
