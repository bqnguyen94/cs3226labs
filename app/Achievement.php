<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    //
    protected $fillable = ['achievement_name','stars'];

    public function students(){
        $this->belongsToMany('App\Student');
    }
}
