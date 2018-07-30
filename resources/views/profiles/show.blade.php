@extends('layouts.app')

@section('title', '用户详情')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2">
                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                        <small>注册于{{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>

                    @can('update', $profileUser)
                        <form action="{{ route('api.users.avatar', $profileUser) }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}

                            <input type="file" name="avatar"/>

                            <button type="submit" class="btn btn-primary">Add Avatar</button>
                        </form>
                    @endcan

                    <img src="{{ $profileUser->avatar_path }}" alt="" width="200" height="200">
                </div>

                @forelse($activities as $date => $activity)
                    <h3 class="page-header">{{ $date }}</h3>

                    @foreach($activity as $record)
                        @if(view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}", ['activity' => $record])
                        @endif
                    @endforeach
                @empty
                    <p>There is no activity for user yet.</p>
                @endforelse

            </div>
        </div>
    </div>

@endsection

