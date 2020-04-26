<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use UUIDGenerator;

    public $incrementing = false;

    public $fillable = [
        'user_id', 'telephone_number'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
