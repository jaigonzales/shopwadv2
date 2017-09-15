@extends('layouts.app')
@section('pageTitle', 'Find friends')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h5>Found {{ $results->count() }} user(s) with keyword <em>"{{ Request::get('q')  }}"</em></h5>
            <hr>
            <ul class="search-results-list list-group">
                @foreach ($results as $user)
                    <li class="search-res-item list-group-item">
                        <div class="res-item container-fluid">
                            <div class="row-fluid">
                                <div class="user-sm-avatar pull-left"><a href="{{ URL::to('/') }}/profile?pid={{ $user->id }}"><img src="{{ $user->avatar }}" width="52" height="52"/></div>
                                <div class="user-details pull-left">

                                        <strong>
                                            {{ $user->firstname }} {{ $user->lastname }}
                                        </strong>
                                    </a>
                                    @if ( $user->id === Auth::user()->id )
                                        <span class="label label-default" style="color: #fff">You</span>
                                    @else
                                        <add-friend-button :senderid="{{ Auth::user()->id }}" :receiverid="{{ $user->id }}"></add-friend-button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div style="text-align: center">
                {{ $results->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection