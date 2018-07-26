<?php

namespace App\Http\Controllers;

use App\Broker\ProfileBroker;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        // 动作流按日期分组
        $activities = ProfileBroker::feed($user);

        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => $activities,
        ]);
    }
}
