<div class="user-info-container">
    <div class="user-avatar">
        <div class="avatar-mask">
            <img src={{ $user->avatar }} width="152" height="152"/>
        </div>
    </div>
    <div class="user-info">
        <div class="user-name">
            <div><h1 class="profile-name">{{ $user->firstname }} {{ $user->lastname }}</h1></div>
            <div>
                <i class="fa fa-gift" aria-hidden="true"></i>
                @if ( $user->birthday )
                    <?php
                    $bday = new DateTime($user->birthday);
                    echo date_format($bday, 'jS F Y');
                    ?>
                @else
                    Not set
                @endif
            </div>
            @if ( !Auth::guest() )
                <add-friend-button :senderid="{{ Auth::user()->id }}" :receiverid="{{ $_GET['pid'] }}"></add-friend-button>
            @endif
        </div>
        <div class="user-counts">
            <ul>
                <li><strong>{{ $p_shoplistTotal }}</strong> shoplists</li>
                <li><strong>{{ $p_productTotal }}</strong> products</li>
            </ul>
        </div>
        @if ( !Auth::guest() )
            @include('includes.p_opt')
        @endif
    </div>
</div>