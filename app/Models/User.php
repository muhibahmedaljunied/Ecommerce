<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// sanctum
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * Helper to check admin role
     */
    public function isAdmin()
    {
        return (bool) ($this->is_admin ?? false);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * Check if user has a given role (by name)
     */
    public function hasRole($role)
    {
        if (!$this->roles) return false;
        return $this->roles->pluck('name')->contains($role);
    }

    /**
     * Check if user has a permission (via roles)
     */
    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->pluck('name')->contains($permission)) {
                return true;
            }
        }
        return false;
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
