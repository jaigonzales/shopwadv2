@extends('layouts.app')
@section('pageTitle', 'Log in')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <div class="auth-form">
                        <div class="m-b-md">
                            <h3 class="form-headers">Log in</h3>
                        </div>
                        <div class="m-b-md">
                            <div style="text-align: center">
                                <a href="/auth/facebook" class="btn btn-facebook btn-outline btn-lg btn-block"><i
                                            class="fa fa-facebook" aria-hidden="true" style="margin-right: 10px"></i>
                                    Continue with Facebook
                                </a>
                            </div>
                        </div>
                        <div class="m-b-md" style="text-align: center">
                            <div class="divider">
                                <span>or</span>
                            </div>
                        </div>
                        <div class="m-b-md">
                            @if(Session::has('alert'))
                                <div class="alert alert-success">
                                    {{ Session::get('alert') }}
                                    @php
                                        Session::forget('alert');
                                    @endphp
                                </div>
                            @endif
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">E-Mail Address</label>

                                    <div>
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Password</label>

                                    <div>
                                        <input id="password" type="password" class="form-control" name="password"
                                               required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       name="remember" {{ old('remember') ? 'checked' : '' }}> Remember
                                                Me
                                            </label>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
                                </div>
                            </form>
                            <div class="m-b-md" style="text-align: center">
                                No account yet? <a href="{{ route('register') }}">Register</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
