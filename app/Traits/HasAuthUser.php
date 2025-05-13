<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait HasAuthUser
{
    public function getAuthUser(): User
    {
        /** @var User */
        return Auth::user();
    }
}
