<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;

    public function osnova() {
        return $this->belongsTo('App\student_osnova', 'osn_obuch', 'id');
    }
    public function groups() {
        return $this->belongsTo('App\Group', 'group_id','id');
    }
    public function statuses() {
        return $this->belongsTo('App\student_status', 'status', 'id');
    }
}
