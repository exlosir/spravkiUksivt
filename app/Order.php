<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // use Enums;

    // protected $enumType = [
    //     0 => 'Зачисление',
    //     1 => 'Отчисление',
    //     2 => 'Академический отпуск',
    //     3 => 'Восстановление',
    // ];

    public $timestamps = false;

    public function type_orders() {
        return $this->belongsTo('App\TypeOrder', 'type', 'id');
    }
}
