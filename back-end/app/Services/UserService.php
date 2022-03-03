<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function get_user(int $user_id)
    {
        if (!$user_id) {
            return null;
        }

        return User::find($user_id);
    }
}