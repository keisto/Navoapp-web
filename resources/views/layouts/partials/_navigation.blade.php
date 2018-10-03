
    @guest
        <a class="item" href="{{ route('home') }}" style="padding-top: 4px; padding-bottom: 4px">
            <img src="{{ asset('images/navo-large-solid.svg') }}" height="28px">
            Navo
        </a>
    @else
        <a class="item" href="{{ route('search') }}">
            <i class="search icon"></i>
            Search
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
                    <div class="ui floating dropdown">
                        <div class="ui text">
                            <img class="ui avatar image" style="border-radius: 4px" src="https://api.adorable.io/avatars/285/{{ Auth::user()->name }}.png">
                            {{ Auth::user()->name }} <i class="dropdown icon"></i></div>
                        <div class="menu">
                            <a class="item" href="{{ url("account") }}"><i class="user green yellow icon"></i> Account</a>
                            <a class="item" href="{{ url("account") }}"><i class="star circle yellow icon"></i> Favorites</a>
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
