<?php

namespace App\Services;

use App\Filters\ThreadsFilters;
use App\Models\Channel;
use App\Models\Thread;

class ThreadsServices
{
    public function getThreads(Channel $channel, ThreadsFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        $threads = $threads->get();

        return $threads;
    }
}