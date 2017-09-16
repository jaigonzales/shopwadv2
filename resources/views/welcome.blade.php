@extends('layouts.wc')
@section('content')
<div class="content">
    <section id="homepage-slide">
        <div id="welcomebg">
            <img src="https://res.cloudinary.com/dxjpawbvm/image/upload/v1505523861/img/welcomebg.png">
        </div>
        <div class="container" style="height: 100%">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="tag-line">Here’s how we do what we do while you do what you love!</h1>
                    <br />
                    @if ( Auth::guest() )
                        <a href="{{ route('register') }}" class="btn btn-xl btn-red-outline">
                           Create your Shoplist
                        </a>

                        <h5>Already have an account? <a href="{{ route('login') }}">Log in</a></h5>
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
            <div class="home-wid">
                <div>
                    <img src="https://res.cloudinary.com/dxjpawbvm/image/upload/v1505578320/img/w01_02.png" width="170" height="139">
                </div>
                <h3 class="home-wid-title">Getting Started</h3>
                <p>It’s easy to get started by creating as many custom shopping bags as your heart (or wallet) desires.</p>
            </div>
            <div class="home-wid">
                <div>
                    <img src="https://res.cloudinary.com/dxjpawbvm/image/upload/v1505578320/img/w02_02.png" width="170" height="139">
                </div>
                <h3 class="home-wid-title">Privacy Settings</h3>
                <p>Don’t be shy! You can always tailor shoppers’ views by enabling your shopping bag to be public for all to see, sharing with specific friends or having it remain totally private. The choice is yours.</p>
            </div>
            <div class="home-wid">
                <div>
                    <img src="https://res.cloudinary.com/dxjpawbvm/image/upload/v1505578320/img/w03_2.png" width="170" height="139">
                </div>
                <h3 class="home-wid-title">Product Links</h3>
                <p>Easily build endless shopping options by adding links for any (yes ANY) website to your tailor-made bag.</p>
            </div>
            <div class="home-wid">
                <div>
                    <img src="https://res.cloudinary.com/dxjpawbvm/image/upload/v1505578320/img/w04_02.png" width="170" height="139">
                </div>
                <h3 class="home-wid-title">Save and Share it!</h3>
                <p>Now or Later? You decide whether, if ever, to share with other shoppers or to save it for whenever!</p>
            </div>
        </div>
    </section>

</div>
@endsection