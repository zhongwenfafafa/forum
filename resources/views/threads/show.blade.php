@extends('layouts.app')

@section('content')
    <thread-view inline-template :initial-replies-count="{{ $thread->replies_count }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="level">
                            <span class="flex">
                                <a href="{{ route('profiles.show', $thread->creator) }}">{{ $thread->creator->name }}</a> 发表了:
                                {{ $thread->title }}
                            </span>
                                @can('update', $thread)
                                    <form action="{{ $thread->path() }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-link" type="submit">Delete Thread</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ $thread->body }}
                        </div>
                    </div>

                    <replies @removed="backRepliesCount" @added="addRepliesCount"></replies>

                </div>
                <div class="col-md-4">
                    <sidebar :data="{{ $thread->creator }}" :count="repliesCount"></sidebar>
                </div>
            </div>
        </div>
    </thread-view>
@endsection
