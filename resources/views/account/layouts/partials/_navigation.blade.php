<a class="item {{ request()->is('account') ? 'active' : '' }}" href="{{ route('account.index') }}">
    Account Overview
</a>
<a class="item {{ request()->is('*/profile') ? 'active' : '' }}" href="{{ route('account.profile.index') }}">
    User Profile
</a>
<a class="item {{ request()->is('*/password') ? 'active' : '' }}" href="{{ route('account.password.index') }}">
    Change Password
</a>
<a class="item {{ request()->is('*/deactivate') ? 'active' : '' }}" href="{{ route('account.deactivate.index') }}">
    Deactivate Account
</a>
{{--<div class="ui floating dropdown item">--}}
    {{--<i class="dropdown icon"></i>--}}
    {{--Display Options--}}
    {{--<div class="menu">--}}
        {{--<div class="header">Text Size</div>--}}
        {{--<a class="item">Small</a>--}}
        {{--<a class="item">Medium</a>--}}
        {{--<a class="item">Large</a>--}}
    {{--</div>--}}
{{--</div>--}}

@subscribed
    @notpiggybacksubscription
        <div class="ui divider"></div>
        @notcancelled
            <a class="item {{ request()->is('*/plan') ? 'active' : '' }}" href="{{ route('account.subscription.plan.index') }}">
                Change Plan
            </a>
            <a class="item {{ request()->is('*/cancel') ? 'active' : '' }}" href="{{ route('account.subscription.cancel.index') }}">
                Cancel Subscription
            </a>
        @endnotcancelled
        @cancelled
            <a class="item {{ request()->is('*/resume') ? 'active' : '' }}" href="{{ route('account.subscription.resume.index') }}">
                Resume Subscription
            </a>
        @endcancelled
        @customer
        <a class="item {{ request()->is('*/card') ? 'active' : '' }}" href="{{ route('account.subscription.card.index') }}">
            Update Card
        </a>
        @endcustomer
        @teamsubscription
        <a class="item {{ request()->is('*/team') ? 'active' : '' }}" href="{{ route('account.subscription.team.index') }}">
            Manage Team
        </a>
        @endteamsubscription
    @endnotpiggybacksubscription
@endsubscribed
