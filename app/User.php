<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use jeremykenedy\LaravelRoles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use Notifiable, HasApiTokens, UUIDGenerator, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'application', 'status', 'birthday', 'mother_name', 'father_name', 'profession',
        'identity_number', 'issuing_authority', 'issuing_date', 'marital_status', 'cpf', 'scholarship_level',
        'latest_school', 'voter_id_number', 'voter_id_zone', 'voter_id_section', 'facebook_link', 'instagram_link',
        'whatsapp_number', 'naturalness_country', 'naturalness_state', 'voter_id_state', 'issuing_id_state'
    ];

    public static $encrypted = [
        'cpf', 'voter_id_number', 'voter_id_zone', 'voter_id_section', 'identity_number'
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
        return $this->hasOne('App\UniversityCampus');
    }

    public function telephones() {
        return $this->hasMany('App\Telephone');
    }
}
