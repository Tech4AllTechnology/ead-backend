<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'initials', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    public function getCountryList() {
        return Country::whereNull('deleted_at')->get();
    }


    public function states() {
        return $this->hasMany('App\State', 'country_id','id');
    }

    public function users() {

    }
}
