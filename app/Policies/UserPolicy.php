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
    public function __construct(User $user)
    {
        
    }

    public function checkAdmin(User $user) {
        return false;
        return $user->type != 'admin';
    }
}
