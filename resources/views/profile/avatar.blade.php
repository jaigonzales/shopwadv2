@extends('layouts.app')
@section('pageTitle', 'Avatar')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div id="main-content">
                    <h5 class="text-center">Only .jpg, .jpeg, and .png image formats will be accepted.</h5>
                    <div class="text-center avatar-preview">
                        @if ( strpos( Auth::user()->avatar, 'facebook')  )
                            <img src="http://graph.facebook.com/{{ Auth::user()->provider_user_id  }}/picture?width=320" id="current-avatar">
                        @else
                            <img src="{{ Auth::user()->avatar }}" width="320" id="current-avatar">
                        @endif
                    </div>
                    <div class="text-center">
                        <form method="post" action="/avatar" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}
                            <label id="upload-img-area">
                                <input type="file" id="new_avatar" name="new_avatar" accept="image/*" style="display: none;"/>
                                <i class="fa fa-upload" aria-hidden="true"></i> Upload avatar
                            </label>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection