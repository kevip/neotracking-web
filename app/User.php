<?php

namespace App;

use App\Models\Track;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'company',
        'phone_number',
        'status',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    public function tracking(){
        return $this->hasMany(Track::class, 'usr');
    }
}
