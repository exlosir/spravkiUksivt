<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false; // отключение меток времени

    public function specialties() {
       return $this->belongsTo('App\Specialty', 'specialty_id', 'id');
    }

    public function departments() {
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function orders() {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }
}
