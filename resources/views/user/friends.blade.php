@extends('layouts.static')
@section('pageTitle', 'Fellow Shoppers')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center"><a href="{{ route('profile', ['pid' => \Request::input('pid')]) }}"><span class="badge">{{ $g_user->firstname }} {{ $g_user->lastname }}'s</span></a></p>
                <h1 class="page-title text-center">Fellow Shoppers</h1>
                <hr>
                @if ( $friends )
                    <ul class="search-results-list list-group row">
                        @foreach ($friends as $user)
                            <li class="search-res-item list-group-item col-md-6">
                                <div class="res-item container-fluid">
                                    <div class="row-fluid">
                                        <div class="user-sm-avatar pull-left"><img src="{{ $user->avatar }}" width="52" height="52"/></div>
                                        <div class="user-details pull-left">
                                            <a href="{{ route('profile', ['pid' => $user->id]) }}">
                                                <strong>
                                                    {{ $user->firstname }} {{ $user->lastname }}
                                                </strong>
                                            </a>
                                            <div>
                                            <span class="sub-labels sx">{{ $totalShoplists }} shoplists ⋅ {{ $totalProducts }} items</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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