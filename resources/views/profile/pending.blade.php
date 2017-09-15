@extends('layouts.app')
@section('pageTitle', 'Find friends')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="page-title text-center">Friend Requests</h1>
                <hr>
                @if ( count($requests) >= 1 )
                <ul class="search-results-list list-group row">
                    @foreach ($requests as $request)
                        <li class="search-res-item list-group-item col-md-6">
                            <div class="res-item container-fluid">
                                <div class="row-fluid">
                                    <div class="user-sm-avatar pull-left"><img src="{{ $request->sender->avatar }}" width="52" height="52"/></div>
                                    <div class="user-details pull-left">
                                        <div>
                                        <a href="{{ route('profile', ['pid' => $request->sender->id]) }}">
                                            <strong>{{ $request->sender->firstname }} {{ $request->sender->lastname }}</strong>
                                        </a>
                                        </div>
                                        <approval-buttons :senderid="{{ $request->sender->id }}"></approval-buttons>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @else
                    <p class="text-center">You don't have pending friend requests to approve yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection