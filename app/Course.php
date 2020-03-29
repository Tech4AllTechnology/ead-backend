<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use UUIDGenerator, SoftDeletes;

    public $fillable = [
        'name', 'status', 'credit', 'period', 'code'
    ];

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public function programItems() {
        return $this->belongsToMany('App\Program', 'course_program', 'course_id', 'program_id');
    }

    public function getCourseList() {
        return Course::whereNull('deleted_at')->with('programItems:id,name')->get();
    }

    public function checkCourseExists($name) {
        return Course::where('name', '=', $name)->where('status', '=', 1)->exists();
    }


}
