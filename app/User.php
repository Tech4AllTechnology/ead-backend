<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;


class User extends Authenticatable
{
    use Notifiable, HasApiTokens, UUIDGenerator, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function getUsersList() {
        return User::whereNull('deleted_at')->get();
    }

    public function state() {
        return $this->belongsTo('App\State');
    }

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function campus() {
        return $this->hasMany('App\UniversityCampus');
    }

}
