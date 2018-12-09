<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal_zayav extends Model
{
    public $table = 'journal_zayav';


    public function status_zayav() {
        return $this->belongsTo(status_zayav::class);
    }

    public function type_spravka() {
        return $this->belongsTo(Types_spravka::class);
    }

    public function students() {
        return $this->belongsTo(Student::class);
    }
}
