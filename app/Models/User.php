<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
    'two_factor_type',
    'phone_number'
  ];
  protected $hidden = [
    'password',
    'remember_token',
  ];
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function activeCode()
  {
    return $this->hasMany(ActiveCode::class);
  }

  public function has2Fa($user)
  {
    return $user->two_factor_type !== 'disable';
  }

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }

  public function hasPermission($permission)
  {
    return $this->permissions->contains('id', $permission->id);
  }

  public function hasRole($roles)
  {
    return !!$this->roles->intersect($roles)->all();
  }

  public function permissions()
  {
    return $this->belongsToMany(Permission::class);
  }

  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }
}
