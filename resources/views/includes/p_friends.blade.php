<h3 class="widget-title">
    Fellow Shoppers ⋅ <a href="{{ route('p_friends', ['pid' => \Request::input('pid')]) }}">{{ $p_friendsTotal }}</a>
</h3>
<div class="friends-widget">

    @if ( $p_friendsTotal >= 1 )
    <ul class="friends-list">

        @foreach( $p_friends as $friend )
        <li>
            <?php
                if ( (Auth::check()) && (Auth::user()->id === $friend->id) ){
                    $user_link = route('home');
                }else{
                    $user_link = route('profile', ['pid' => $friend->id]);
                }
                ?>
            <a href="{{ $user_link }}"
               data-toggle="tooltip"
               title="{{ $friend->firstname }} {{ $friend->lastname }}"
               data-original-title="{{ $friend->firstname }} {{ $friend->lastname }}">
                <div class="user-sm-avatar">
                    <img src="{{ $friend->avatar }}" width="">
                </div>
            </a>
        </li>
        @endforeach
    </ul>
    @else
        <p>No friends yet.</p>
    @endif
</div>
<!-- 200x200 ad space -->
@include('includes.ad_square')

<h3 class="widget-title">Invite your friends</h3>
@include('includes.invite_friends')