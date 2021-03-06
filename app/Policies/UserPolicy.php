<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function isAdmin(User $user){
        return $user->role == User::ROLE_ADMIN;
    }

    public function isUser(User $user){
        return $user->role == User::ROLE_USER;
    }

    public function isModerator(User $user) {
        return $user->role == User::ROLE_MODERATOR;
    }
}
