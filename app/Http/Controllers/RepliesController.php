<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReliesRequest;
use App\Models\Reply;
use App\Models\Thread;
use App\Inspections\Spam;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(10);
    }

    public function store(ReliesRequest $request, $channelId, Thread $thread, Spam $spam)
    {
        $this->authorize('create', new Reply());

        $reply =$thread->addReply([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        if ($request->expectsJson()) {
            return $reply->load('owner');
        }
    }

    public function update(Reply $reply, ReliesRequest $request, Spam $spam)
    {
        $this->authorize('update', $reply);

        $reply->update($request->all());
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        $reply->delete();

        if (\request()->expectsJson()) {
            return response()->json(['status' => 'Reply deleted']);
        }

        return back();
    }
}
