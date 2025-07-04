<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Define the many-to-many relationship with permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
