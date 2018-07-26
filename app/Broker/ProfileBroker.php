<?php

namespace App\Broker;

use App\Models\User;

class ProfileBroker
{
    public static function feed(User $user, $take = 50)
    {
        return $user->activity()->latest()->with('subject')->take($take)->get()->groupBy(function($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }
}