<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clazz extends Model
{
    use UUIDGenerator, SoftDeletes;
    protected $table = 'clazz';

    public $incrementing = false;

    public $fillable = [
        'name', 'status', 'shift', 'semester', 'course_id', 'master_id', 'initial_date', 'end_date'
    ];

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    protected $appends = ['filterDate', 'initialTime', 'endTime', 'weekdays'];

    public function checkClazzExists($name) {
        return Clazz::where('name', '=', $name)->where('status', '=', 1)->exists();
    }

    public function getFilterDateAttribute() {
        return [
            $this->initial_date, $this->end_date
        ];
    }

    public function getInitialTimeAttribute() {
        return $this->times()->first()->initial_time ?? null;
    }

    public function getEndTimeAttribute() {
        return $this->times()->first()->end_time ?? null;
    }

    public function getWeekDaysAttribute() {
        $weekdays = $this->times()->select('weekday')->distinct()->get()->toArray() ?? [];
        $weekday = [];
        array_walk_recursive(
            $weekdays, function ($value) use (&$weekday) {
                array_push($weekday, ['id' => $value, 'name' => ClazzTime::$weekdayName[$value]]);
            }
            );
        return $weekday;
    }


    public function getClazzList() {
        return Clazz::whereNull('deleted_at')
            ->with('times')
            ->with('course:id,name')
            ->with('master:id,name')
            ->get();
    }

    public function times() {
        return $this->hasMany('App\ClazzTime');
    }

    public function course() {
        return $this->belongsTo('App\Course')->with('programItems');
    }

    public function master() {
        return $this->belongsTo('App\User');
    }
}
