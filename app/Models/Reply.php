<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Favoriteable;
use App\Traits\RecordsActivity;

class Reply extends Model
{
    use Favoriteable, RecordsActivity;

    protected $guarded = [];
    protected $with = ['owner', 'favorites'];
    protected $appends = ['favoritesCount', 'isFavorited'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path()
    {
        return $this->thread->path() ."#reply-{$this->id}";
    }

}
