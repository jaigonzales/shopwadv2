@extends('layouts.static')
@section('pageTitle', $shoplist->title)
@section('content')
    @include('includes.p_userInfo')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">

                <div>

                <h2><a href="{{ route('profile', ['pid' => \Request::input('pid')]) }}"><span class="badge"><i class="fa fa-reply" aria-hidden="true"></i> Shoplists</span></a> {{ $shoplist->title }}</h2>
                <p>
                    @if ( !empty($shoplist->desc) )
                        {{ $shoplist->desc }}
                    @else
                        <em style="color: #a7a7a7">No description</em>
                    @endif
                </p>
                </div>
                <div>
                    @if ( count($products) >= 1 )
                        <div>
                    <ul class="products list-group">
                        @foreach ( $products as $product )
                        <li class="product-item list-group-item">
                            <div class="row">
                                <div class="product-contents col-sm-10">
                                    <h4 class="product-title">
                                        <a href="{{ $product->product_url }}" target="_blank" rel="nofollow" class="product-title">{{ $product->product_name }}</a>
                                    </h4>
                                    <ul class="product-details">
                                        <li class="product-detail prod-size">
                                            <div class="cust-label" style="background-color: #fb5a8e">Size</div>
                                            <div class="detail" style="background-color: #ffc3d6">{{ $product->size }}</div>
                                        </li>
                                        <li class="product-detail prod-color">
                                            <div class="cust-label" style="background-color: #2f96d2">Color</div>
                                            <div class="detail" style="background-color: #c2e8ff">{{ $product->color }}</div>
                                        </li>
                                        <li class="product-detail prod-quantity">
                                            <div class="cust-label" style="background-color: #00b58b">Quantity</div>
                                            <div class="detail" style="background-color: #b8fbeb">{{ $product->quantity }}</div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </li>
                        @endforeach
                    </ul>
                        </div>
                        <div>{{ $products->appends($_GET)->links() }}</div>
                        @else
                        <div class="shopbag-content">
                            <table class="empty-list-container">
                                <tr>
                                    <td class="align-middle">
                                        <h3>Shopping bag is empty.</h3>
                                        <p><em>Please come back later.</em></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @endif
                </div>

            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    @include('includes.p_friends')
                </div>
            </div>
        </div>
    </div>
    @endsection