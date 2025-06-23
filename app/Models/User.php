<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User has many products through orders
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product_detail')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // Define the many-to-many relationship with roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    // Define the many-to-many relationship with permissions through roles
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }


    // public function hasRole($role)
    // {
    //     return $this->roles->contains('name', $role);
    // }
    public function hasRole($roles)
    {
        return $this->roles->contains(function ($role) use ($roles)  {
            return in_array($role->name, (array) $roles);
        });
    }

    // Custom method to assign a role to the user
    public function assignRole($roleName)
    {
        $role = Role::where('name', $roleName)->first();

        if ($role) {
            $this->roles()->attach($role);
        } else {
            throw new \Exception("Role '{$roleName}' does not exist.");
        }
    }

    // Checking if user has a specific permission
    public function hasPermissionTo($permissionName)
    {
        // Check if the user has the permission directly through the user-to-permission relationship
        $directPermission = $this->permissions()->where('permissions.name', $permissionName)->exists();
        // Check if the user has the permission through any of their roles
        $rolePermission = $this->roles->flatMap(function ($role) {
            return $role->permissions;
        })->pluck('name')->contains($permissionName);
        // Return true if the user has the permission either directly or through a role
        return $directPermission || $rolePermission;
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
