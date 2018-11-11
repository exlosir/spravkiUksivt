<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal_zayav extends Model
{
    public function group(){
        return $this->hasOne(Group::class);
    }
}
