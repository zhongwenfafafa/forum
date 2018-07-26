<?php

namespace App\Http\Controllers;

use App\Filters\ThreadsFilters;
use App\Http\Requests\ThreadsRequest;
use App\Models\Channel;
use App\Models\Thread;
use App\Services\ThreadsServices;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Channel $channel, ThreadsFilters $filters, ThreadsServices $services)
    {
        $threads = $services->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', compact('threads'));
    }

    public function show($channelId, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    public function create()
    {
        return view('threads.create');
    }

    public function store(ThreadsRequest $request)
    {
        $data = $request->all();
        $thread = Thread::create(array_merge($data, ['user_id' => auth()->id()]));

        return redirect($thread->path())->with('flash', 'Your thread has been published!');
    }

    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        if (\request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/threads');
    }
}
