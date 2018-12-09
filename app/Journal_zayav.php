<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal_zayav extends Model
{
    public $table = 'journal_zayav';


    public function status_zayav() {
        return $this->belongsTo(status_zayav::class, 'status', 'id');
    }

    public function type_spravka() {
        return $this->belongsTo(Types_spravka::class, 'type_id', 'id');
    }

    public function groups() {
        return $this->belongsTo(Group::class, 'group_id','id');
    }

    public function students() {
        return $this->belongsTo(Student::class, 'student_id','id');
    }
}
