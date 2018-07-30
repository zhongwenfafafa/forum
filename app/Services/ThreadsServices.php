<?php

namespace App\Services;

use App\Filters\ThreadsFilters;
use App\Models\Channel;
use App\Models\Thread;

class ThreadsServices
{
    public function getThreads(Channel $channel, ThreadsFilters $filters)
    {
        // 接受返回的模型查询构建器
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        $threads = $threads->paginate(20);

        return $threads;
    }
}