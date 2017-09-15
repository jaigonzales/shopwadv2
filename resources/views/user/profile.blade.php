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
                                        <span> items</span>
                                    </div>
                                    @if ( !empty($shoplist->desc) )
                                    <div class="user-list-desc">{{ $shoplist->desc }}</div>
                                    @else
                                    <div class="user-list-desc"><em>No description</em></div>
                                    @endif
                                </div>
                            </div>
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