<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_student extends Model
{
    public $timestamps = false;
    public $table = 'order_student';

    public function type_orders() {
        return $this->belongsTo(TypeOrder::class, 'type', 'id');
    }
}
