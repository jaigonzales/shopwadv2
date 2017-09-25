@extends('layouts.static')
@section('pageTitle', $user->firstname . ' ' . $user->lastname)
@section('content')

@include('includes.p_userInfo')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <h2>Shoplists</h2>
                @if ( count($p_shoplists) >= 1 )
                    <ul class="shoplists-list list-group">
                        @foreach ( $p_shoplists as $shoplist )
                        <li class="list-group-item shoplist-item">
                            <div class="list">
                                <div class="list-content">
                                    <div class="user-list-title">
                                        <a href="{{ route('p_shoplist', array('pid' => \Request::input('pid'), 'swid' => $shoplist->id ) ) }}">{{ $shoplist->title }}</a></div>
                                    <div class="publish-details">
                                        <?php
                                            $created = new DateTime($shoplist->created_at);
                                            echo date_format($created, 'd F Y');
                                        ?>
                                        <span> &#8901; </span>
                                            @if ( $shoplist->privacy == 0 )
                                                <i class="fa fa-globe" aria-hidden="true"></i>
                                            @elseif ( $shoplist->privacy == 1 )
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            @endif
                                        <span> &#8901; </span>
                                        <span>{{  App\Product::where('user_id', $_GET['pid'])->where('shoplist_id', $shoplist->id)->count() }} items</span>
                                    </div>
                                    @if ( !empty($shoplist->desc) )
                                    <div class="user-list-desc">{{ $shoplist->desc }}</div>
                                    @else
                                    <div class="user-list-desc"><em>No description</em></div>
                                    @endif
                                    <div class="btn-group pull-right tiny-opt-link">
                                        <button type="button" class="btn-no-border btn-norm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-cogs" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-header">Share it</li>
                                            <li>
                                                <a href="#" class="fbShareUrlBtn" data-fblink="p_shoplist?pid={{ $_GET['pid'] }}&swid={{ $shoplist->id }}">
                                                    <i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/intent/tweet?text=I%20created%20a%20shoplist!%20Check%20it%20out!%20http%3A//www.shopwad.com/p_shoplist?pid={{ $_GET['pid'] }}%26swid={{ $shoplist->id }}" class="twShareUrlBtn">
                                                    <i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter
                                                </a>
                                            </li>
                                            <li>
                                                <a href="mailto:?Subject=Check%20out%20my%20shoplist%21&Body=Shoplist%20by%20{{$user->firstname}}%20{{ $user->lastname }}%0ASee%20it%20here%3A%20http%3A//www.shopwad.com/p_shoplist?pid={{ $_GET['pid'] }}%26swid={{ $shoplist->id }}%0A%0AShop%20Wad%20-%20Where%20Every%20Gift%20Is%20A%20Hit%21%0AJoin%20the%20fun%20in%20shopping%20and%20share%20your%20list%20with%20anyone%21%0Ahttp%3A//www.shopwad.com%0A%0A">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i> Email
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <span class="bagIcon"><img src="{{ asset('/images/bagIcon.png') }}"></span>
                        </li>
                        @endforeach
                    </ul>
                    {{ $p_shoplists->appends(['pid' => \Request::input('pid')])->links() }}
                @else
                    <table class="empty-list-container">
                        <tr>
                            <td class="align-middle">
                                <h3>No shoplists yet.</h3>
                            </td>
                        </tr>
                    </table>
                @endif
            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    @include('includes.p_friends')
                </div>
            </div>
        </div>
    </div>

@endsection