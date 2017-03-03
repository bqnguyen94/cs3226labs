<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'user_id', 'nick', 'image', 'kattis', 'country_iso2', 'country_iso3'];

    public function score() {
        return $this->hasOne('Score');
    }

    public function user(){
        return $this->hasOne('App\User');
    }

    public function achievements(){
        $this->belongsToMany('App\Achievement');
    }

    public function message() {
        return $this->hasOne('App\Message');
    }
}
