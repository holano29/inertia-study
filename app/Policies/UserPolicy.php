<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool {
        return $user->email === 'jose@themail.com';
    }

    public function edit(User $user, User $model): bool {
        return mt_rand(0, 1); // This is just for demonstration, you must implement the real program logic later
    }
}
