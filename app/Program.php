<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use UUIDGenerator, SoftDeletes;
    protected $fillable = [
        'name', 'code', 'status', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    public function getProgramList() {
        return Program::whereNull('deleted_at')->get();
    }

    public function checkProgramExists($name) {
        return Program::where('name', '=', $name)->where('status', '=', 1)->exists();
    }
}
