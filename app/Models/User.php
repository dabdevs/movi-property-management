<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable 
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withPivot('assigned_at'); 
    }

    public function hasRole(string $role): bool
    {
        return $this->role->name === $role;
    }

    public function hasPermission(string $permission): bool
    {
        return $this->role->permissions->contains('name', $permission);
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role->name, $roles);
    }

    public function assignRole(Role $role)
    {
        $this->roles()->attach($role, ['assigned_at' => now()]);
    }
}
