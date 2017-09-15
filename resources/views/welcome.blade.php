@extends('layouts.wc')
@section('content')
<div class="content">
    <section id="homepage-slide">
        <div class="container" style="height: 100%">
            <div class="row">
                <div class="col-md-6">
                    <h1>Create and share your </br />shopping lists with your friends.</h1>
                    <br >
                    <h4>Save your favorite products to <br />your shopping list.</h4>
                    <br />
                    @if ( Auth::guest() )
                        <a href="{{ route('login') }}" class="btn btn-xl btn-primary">
                           Get Started
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-xl btn-danger">Create a Shoplist</a>
                    @endif
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>
    <section id="homepage-dedatils">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h1><i class="fa fa-paper-plane" aria-hidden="true"></i></h1>
                    <h3>Get Started</h3>
                    <p>Register and start creating your own shopping list and save your favorite products to your list.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h1><i class="fa fa-share-alt" aria-hidden="true"></i></h1>
                    <h3>Discover &amp; Share</h3>
                    <p>Let your friends discover what’s in your shopping list by sharing it. You can also choose the type of privacy for each lists.</test>
                </div>
                <div class="col-md-4 text-center">
                    <h1><i class="fa fa-users" aria-hidden="true"></i></h1>
                    <h3>Invite Friends</h3>
                    <p>Connect with your friends and other shoppers to discover what’s in their shopping list.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection