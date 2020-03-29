<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniversityCampus extends Model
{
    use UUIDGenerator, SoftDeletes;

    protected $table = 'university_campus';

    public $fillable = [
        'name', 'status', 'state', 'responsible_id'
    ];

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public function checkUniversityCampusExists($name) {
        return UniversityCampus::where('name', '=', $name)->where('status', '=', 1)->exists();
    }

    public function getUniversityCampusList() {
        return UniversityCampus::whereNull('deleted_at')->with('states:id,name,initial')->with('responsible:id,name')->get();
    }

    public function states() {
        return $this->belongsTo('App\State', 'state');
    }

    public function responsible() {
        return $this->belongsTo('App\User', 'responsible_id');
    }
}
