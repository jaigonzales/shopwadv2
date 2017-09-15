@extends('layouts.app')
@section('pageTitle', 'Blocked Users')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="page-title text-center">Blocked Users</h1>
                <hr>
                @if (count($blocklist) >= 1)
                <ul class="search-results-list list-group row">
                    @foreach ( $blocklist as $blockedUser )
                    <li class="search-res-item list-group-item col-md-6">
                        <div class="res-item container-fluid">
                            <div class="row-fluid">
                                <div class="user-sm-avatar pull-left">
                                    <a href="{{ route('profile', ['pid' => $blockedUser->recipient->id]) }}">
                                        <img src="{{ $blockedUser->recipient->avatar }}" width="52" height="52"/>
                                </div>
                                <div class="user-details pull-left">
                                    <strong>{{ $blockedUser->recipient->firstname }} {{ $blockedUser->recipient->lastname }}</strong>
                                    </a>
                                    <div>
                                        <unblock :recipientid="{{ $blockedUser->recipient->id }}"></unblock>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                    <p class="text-center">No blocked users.</p>
                @endif
            </div>
        </div>
    </div>
@endsection