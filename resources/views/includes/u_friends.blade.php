<?php
    $totalFriends = Auth::user()->getFriendsCount();
?>
<div class="widget">
    <div class="widget-content">
    <h3 class="widget-title">
    Fellow Shoppers ⋅ <a href="{{ route('fellows') }}">{{ $totalFriends }}</a>
</h3>
<div class="friends-widget">
    @if ($totalFriends >= 1)
        <ul class="friends-list">
        @foreach ( $u_friends as $friend )
            <li>
                <a href="{{ route('profile', ['pid' => $friend->id]) }}" data-toggle="tooltip" title="" data-original-title="{{ $friend->firstname }} {{ $friend->lastname }}">
                <div class="user-sm-avatar">
                    <img src="{{ $friend->avatar }}" width="">
                </div>
                </a>
            </li>
        @endforeach
        </ul>
    @else
        No fellow shoppers yet, start inviting.
    @endif
</div>
    </div>
</div>
<hr>
<!-- 200x200 ad space -->
<div class="widget">
    <div class="widget-content">
@include('includes.ad_square')
    </div>
</div>
<hr>
<div class="widget">
    <div class="widget-content">
<h3 class="widget-title">Invite your friends</h3>
@include('includes.invite_friends')
    </div>
</div>