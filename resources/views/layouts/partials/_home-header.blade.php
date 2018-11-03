<div class="page-header">
    <div class="ui center aligned container">
        <div class="ui secondary inverted menu" style="padding-top: 1em; text-shadow: black 0 1px 10px">
        @include("layouts.partials._navigation")
        </div>
    </div>
    <div class="ui container" style="display: flex; flex-grow: 1; height: 80%; justify-content: center; flex-direction: column;">
        <div id="home-header" style="display: flex; justify-content: space-around; align-items: center;">
            <h1 class="ui jumbotron inline header" >
                @guest
                    <img src="{{ asset('images/navo-logo.svg') }}">
                    <div class="content">
                        Oil & Gas Well locator made <u>simple</u>.
                        <div class="sub header" style="color:rgba(255,255,255,0.7) !important;">Individual and Team Plans available! <a href="{{ route('plans.index') }}">Click Here</a></div>
                    </div>
                    @if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet())
                    <a class="ui yellow inline large button" style="margin-left: 32px" href="{{ url('/register') }}">Sign me up!<i class="right arrow icon"></i></a>
                    @else
                    <a class="ui yellow inline large button" href="{{ url('/register') }}">Sign me up!<i class="right arrow icon"></i></a>
                    @endif
                @else
                    @notsubscribed
                        <img src="{{ request()->is('subscription') ? asset('images/subscription.svg') : asset('images/package.svg') }}">
                        <div class="content">
                            {{ request()->is('subscription') ? "Time to checkout" : "Your one step closer." }}
                            @if (request()->is('plans'))
                                Select a plan below.
                            @endif
                            <div class="sub header" style="color:#f6e7ff !important;">
                                {{ request()->is('subscription') ? "Verify your selected plan and add a coupon if you have one." : "Or have someone with a team plan can add you." }}
                            </div>
                        </div>
                        @if (request()->is('/'))
                            <a href='/plans' class='ui yellow inline button'>Select a Plan<i class='right arrow icon'></i></a>
                        @endif
                    @endsubscribed
                @endguest
            </h1>

        </div>
    </div>

    <div style="height: 50px; overflow: hidden;" >
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 12%; width: 100%; margin-bottom: -1px">
            <path d="M0.00,49.98 C149.99,150.00 350.85,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #f1f7fa;"></path>
        </svg>
    </div>
</div>