<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Student;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_MODERATOR = 3;

    public static $roles = [
        self::ROLE_USER=>'User',
        self::ROLE_ADMIN=>'Admin',
        self::ROLE_MODERATOR=>'Moderator',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function student(){
        $this->hasOne('App\Student');
    }

    public static function adminGetNumberOfUnreadMsg() {
        $msgs = 0;
        foreach (Message::all() as $message) {
            if ($message->message != null && $message->reply == null) {
                $msgs++;
            }
        }
        return $msgs;
    }
}
