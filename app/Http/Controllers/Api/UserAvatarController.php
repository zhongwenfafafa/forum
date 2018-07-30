<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserAvatarRequest;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserAvatarController extends Controller
{
    public function store(UserAvatarRequest $request, User $user)
    {
        
    }
}
