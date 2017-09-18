<div class="user-info-container">
    <div class="user-avatar">
        <div class="avatar-mask">
            <img src={{Auth::user()->avatar}} width="152" height="152"/>
        </div>
    </div>
    <div class="user-info">
        <div class="user-name">
            <div><h1 class="profile-name">{{  Auth::user()->firstname }} {{ Auth::user()->lastname }}</h1></div>
            <div>
                <i class="fa fa-gift" aria-hidden="true"></i>
                @if ( Auth::user()->birthday )
                    <?php
                    $bday = new DateTime(Auth::user()->birthday);
                    echo date_format($bday, 'jS F');
                    ?>
                @else
                    Not set (<a href="{{ route('account-settings') }}">set here</a>)
                @endif
            </div>
        </div>
        <div class="user-counts">
            <ul>
                <li><strong>{{ $shoplistsTotal }}</strong> shoplists</li>
                <li><strong>{{ $productsTotal }}</strong> products</li>
            </ul>
        </div>
        <div class="user-shoutout"></div>
    </div>
</div>