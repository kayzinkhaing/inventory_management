<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleUser extends Model
{
    protected $guarded = false;
    protected $table = 'role_user';

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }   
}
