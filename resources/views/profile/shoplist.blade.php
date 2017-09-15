@extends('layouts.app')
@section('pageTitle', $shoplist->title)
@section('content')
    @include('includes.u_userInfo')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <h2><a href="{{ route('home') }}"><span class="badge"><i class="fa fa-reply" aria-hidden="true"></i> Shoplists</span></a> {{ $shoplist->title }}</h2>
                <p>
                    @if ( !empty( $shoplist->desc ) )
                        {{ $shoplist->desc }}
                    @else
                        <em>No description</em>
                    @endif
                </p>
                <products :id="{{ $shoplist->id }}" :userid="{{ Auth::user()->id }}"></products>
            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    @include('includes.u_friends')
                </div>
            </div>
        </div>
    </div>
@endsection