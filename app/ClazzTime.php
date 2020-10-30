<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClazzTime extends Model
{
    use UUIDGenerator;

    protected $table = 'clazz_time';

    public $incrementing = false;

    public $fillable = [
        'clazz_id', 'clazz_day', 'initial_time', 'end_time', 'weekday'
    ];

    public static $weekdays = [
        'SUNDAY' => 0,
        'MONDAY' => 1,
        'TUESDAY' => 2,
        'WEDNESDAY' => 3,
        'THURSDAY' => 4,
        'FRIDAY' => 5,
        'SATURDAY' => 6
    ];

    public static $weekdayName = [
        'SUNDAY' => 'Domingo',
        'MONDAY' => 'Segunda-feira',
        'TUESDAY' => 'Terça-feira',
        'WEDNESDAY' => 'Quarta-feira',
        'THURSDAY' => 'Quinta-feira',
        'FRIDAY' => 'Sexta-feira',
        'SATURDAY' => 'Sábado'
    ];

    public function clazz() {
        return $this->belongsTo('App\Clazz');
    }
}