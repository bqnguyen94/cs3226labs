<?php

namespace App;
use App\Student;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['student_id', 'message', 'reply'];
    protected $primaryKey = 'student_id';

    public function student() {
        return $this->belongsTo('Student');
    }
}
