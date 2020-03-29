<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class Program extends Model
{
    use UUIDGenerator, SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'name', 'code', 'status', 'program_type', 'recognized_by_mec'
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

    public function course() {
        return $this->belongsToMany('App\Course', 'course_program', 'program_id', 'course_id');
    }
}
