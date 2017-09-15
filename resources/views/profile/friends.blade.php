@extends('layouts.app')
@section('pageTitle', 'Fellow Shoppers')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="page-title text-center">Fellow Shoppers ({{ $friendsCount }})</h1>
                <hr>
                @if ( $pendingTotal >= 1 )
                    <div class="alert alert-warning text-center">
                        <p>You have <strong>({{ $pendingTotal }})</strong> pending <a href="{{ route('fellow-requests') }}">friend requests</a>.</p>
                    </div>
                @endif
                @if ( count($friends) >= 1 )
                <ul class="search-results-list list-group row">
                    @foreach ($friends as $user)
                        <li class="search-res-item list-group-item col-md-6">
                            <div class="res-item container-fluid">
                                <div class="row-fluid">
                                    <div class="user-sm-avatar pull-left">
                                        <a href="{{ route('profile', ['pid' => $user->id]) }}">
                                        <img src="{{ $user->avatar }}" width="52" height="52"/>
                                    </div>
                                    <div class="user-details pull-left">
                                            <strong>{{ $user->firstname }} {{ $user->lastname }}</strong>
                                        </a>
                                        <div>
                                            <div class="sub-labels sx">
                                                <strong>{!! \App\Shoplist::where('user_id', $user->id)->count() !!}</strong> shoplists ⋅ <strong>{!! \App\Product::where('user_id', $user->id)->count() !!}</strong> items
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <friend-settings :recipientid="{{ $user->id }}"></friend-settings>
                        </li>
                    @endforeach
                </ul>
                <div style="text-align: center">
                    {{ $friends->links() }}
                </div>
                @else
                    <h4 class="text-center">You have no friends yet.</h4>
                @endif
            </div>
        </div>
    </div>
@endsection