@extends('layouts.app')
@section('pageTitle', Auth::user()->firstname . ' ' . Auth::user()->lastname)
@section('content')

@include('includes.u_userInfo')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <h2>Shoplists</h2>
                <user-lists :userid="{{ Auth::user()->id }}" ></user-lists>
            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    @include('includes.u_friends')
                </div>
            </div>
        </div>
    </div>
@endsection
