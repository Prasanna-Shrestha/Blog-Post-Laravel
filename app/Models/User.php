<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\UserRole;
use Database\Factories\UserFactory;
use App\Models\UserIsActive;
use Dom\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// #[Fillable(['name', 'email', 'password'])]
// #[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $table = "users";
    protected $primaryKey = 'id';
    protected $fillable = [
        "username",
        "email",
        "password"
    ];
    protected $hidden = [
        'password',
    ];
    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class);
    }
    
    public function statuses(): HasMany {
        return $this->hasMany(Status::class);
    }

    public function activeStatus(): HasOne {
        return $this->hasOne(UserIsActive::class);
    }

    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function hasPermission(string $permission): bool
    {
        if ($this->permissions->isNotEmpty()) {
            return $this->permissions
                ->pluck('name')
                ->contains($permission);
        }
        return $this->roles
            ->flatMap(fn($role) => $role->permissions)
            ->pluck('name')
            ->contains($permission);
    }
    public function hasRole(string $role): bool
    {
        return $this->roles->pluck('name')->contains($role);
    }
    public function isAdmin(): bool
    {
        return $this->roles()->where('name', 'admin')->exists();
    }
    public function getIsActiveAttribute(): bool
    {
        return $this->activeStatus?->is_active ?? true;
    }
}
