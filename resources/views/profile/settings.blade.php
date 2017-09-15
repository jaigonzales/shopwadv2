@extends('layouts.app')
@section('pageTitle', 'Account Settings')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div id="main-content">
                    <div class="text-center">
                        <h1 class="page-title">Account Settings</h1>
                        <p>You can update your account details below.</p>
                    </div>
                    <hr>
                    <!-- Profile picture -->
                    <div class="settings_item text-center">
                        <div class="settings-photo">
                            <img src="{{ Auth::user()->avatar  }}" width="100" height="100" id="currentAvatar">
                        </div>
                        <a href="{{  route('avatar')  }}" class="plainButton">Change Avatar</a>
                    </div>
                    <settings-comp :user="{{ Auth::user()->id }}"></settings-comp>
                    <div style="margin: 12px 0">
                        <p>
                            <a href="{{ route('blocklist') }}">Blocked Users</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
