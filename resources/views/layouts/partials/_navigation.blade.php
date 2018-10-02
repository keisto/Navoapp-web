<div class="ui secondary inverted menu" style="padding-top: 1em; text-shadow: black 0 1px 10px">
    @guest
        <a class="item" href="{{ route('home') }}">
            Home
        </a>
        <a class="item" href="#features">
            Features
        </a>
    @else
        <a class="item" href="{{ route('search') }}">
            Search
        </a>
    @endguest
    <div class="right menu">
            @notsubscribed
             <a class="ui item" href="{{ route('plans.index') }}">Plans</a>
            @endnotsubscribed
            @guest
                 <a class="ui item" href="{{ route('login') }}">{{ __('Login') }}</a>
                 <a class="ui item" href="{{ route('register') }}">{{ __('Register') }}</a>
            @else
                <div id="user-nav" class="ui item">
                    <div class="ui floating dropdown">
                        <div class="ui text">
                            <img src="https://api.adorable.io/avatars/285/{{ Auth::user()->name }}.png"
                                 class="ui mini rounded image">{{ Auth::user()->name }} <i class="dropdown icon"></i></div>
                        <div class="menu">
                            <a class="item" href="{{ url("account") }}"><i class="user circle yellow icon"></i> Account</a>
                            <div class="item"><i class="cogs teal icon"></i> Settings</div>
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
</div>
