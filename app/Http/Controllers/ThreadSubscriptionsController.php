<?php

namespace App\Http\Controllers;

use App\Filters\ThreadsFilters;
use App\Http\Requests\ThreadsRequest;
use App\Models\Channel;
use App\Models\Thread;
use App\Services\ThreadsServices;
use Illuminate\Http\Request;

class ThreadSubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($channelId, Thread $thread)
    {
        $thread->subscript();
    }

    public function destroy($channelId, Thread $thread)
    {
        $thread->unsubscribe();
    }
}
