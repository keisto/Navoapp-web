
    @guest
        <a class="item" href="{{ route('home') }}" style="padding-top: 4px; padding-bottom: 4px">
            <img src="{{ asset('images/navo-large-solid.svg') }}" height="28px">
            Navo
        </a>
    @else
        <a class="item {{ request()->is('search') ? 'active' : '' }}" href="{{ route('search') }}">
            <i class="search icon"></i>
            Search
        </a>

            <a class="item @if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet()) @else icon @endif {{ request()->is('*/favorite') ? 'active' : '' }}" href="{{ route("location.favorite.index") }}">
                <i class="star outline icon"></i>
                @if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet()) Favorites @endif
            </a>
            <a class="item @if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet()) @else icon @endif {{ request()->is('*/history') ? 'active' : '' }}" href="{{ route("location.history.index") }}">
                <i class="history icon"></i>
                @if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet()) History @endif
            </a>

    @endguest

    <div class="right menu">
        @notsubscribed
         <a class="ui item" href="{{ route('plans.index') }}">Plans</a>
        @endnotsubscribed
        @guest
             <a class="ui item" href="{{ route('login') }}">{{ __('Login') }}</a>
             <a id="register-button" class="ui item" href="{{ route('register') }}">{{ __('Register') }}</a>
        @else
            <div id="user-nav" class="ui item">
                    <div class="ui @if ((new Jenssegers\Agent\Agent)->isDesktop()) floating @else icon top right pointing @endif dropdown">
                        @if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet())
                        <div class="ui text">
                            <img class="ui avatar image" style="border-radius: 4px" src="https://api.adorable.io/avatars/285/{{ Auth::user()->name }}.png">
                            {{ Auth::user()->name }} <i class="dropdown icon"></i>
                        </div>
                        @else
                            <div class="ui text">
                                <img class="ui avatar image" style="border-radius: 4px" src="https://api.adorable.io/avatars/285/{{ Auth::user()->name }}.png">
                                <i class="bars icon"></i>
                            </div>
                        @endif
                    <div class="menu" style="flex-direction: column">
                        <a class="item" href="{{ url("account") }}"><i class="user circle blue icon"></i> Account</a>
                        @if (!(new Jenssegers\Agent\Agent)->isDesktop() && !(new Jenssegers\Agent\Agent)->isTablet())
                            <a class="item" href="{{ route("location.favorite.index") }}"><i class="star circle yellow icon"></i> Favorites</a>
                            <a class="item" href="{{ route("location.history.index") }}"><i class="history violet icon"></i> History</a>
                        @endif
                        @teamsubscription
                            <a class="item" href="{{ route("account.subscription.team.index") }}"><i class="users green icon"></i> Manage Team</a>
                        @endteamsubscription
                        @piggybacksubscription
                            <a class="item" href="{{ route("team.members.index") }}"><i class="users green icon"></i> View Team</a>
                        @endpiggybacksubscription
                        {{--<div class="item"><i class="cogs teal icon"></i> Settings</div>--}}
                        <div class="divider"></div>
                        <a class="item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="sign out red icon"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endguest
    </div>
