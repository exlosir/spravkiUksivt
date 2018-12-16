<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class journal_spravok extends Model
{
    public $table = 'journal_spravok';
    public $timestamps = false;

    public function zayavka() {
        return $this->hasOne(Journal_zayav::class, 'id', 'zayav_id');
    }
}
