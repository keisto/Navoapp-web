<a class="item {{ request()->is('account') ? 'active' : '' }}" href="{{ route('account.index') }}">
    <i class="address card icon" style="float: left; margin: 0 .75em 0 0"></i>
    Account Overview
</a>
<a class="item {{ request()->is('*/profile') ? 'active' : '' }}" href="{{ route('account.profile.index') }}">
    <i class="user circle icon" style="float: left; margin: 0 .75em 0 0"></i>
    User Profile
</a>
<a class="item {{ request()->is('*/password') ? 'active' : '' }}" href="{{ route('account.password.index') }}">
    <i class="exchange icon" style="float: left; margin: 0 .75em 0 0"></i>
    Change Password
</a>
<a class="item {{ request()->is('*/deactivate') ? 'active' : '' }}" href="{{ route('account.deactivate.index') }}">
    <i class="power off icon" style="float: left; margin: 0 .75em 0 0"></i>
    Deactivate Account
</a>

@subscribed
    @notpiggybacksubscription
        <div class="ui divider"></div>
        @notcancelled
            <a class="item {{ request()->is('*/plan') ? 'active' : '' }}" href="{{ route('account.subscription.plan.index') }}">
                <i class="boxes icon" style="float: left; margin: 0 .75em 0 0"></i>
                Change Plan
            </a>
            <a class="item {{ request()->is('*/cancel') ? 'active' : '' }}" href="{{ route('account.subscription.cancel.index') }}">
                <i class="window close icon" style="float: left; margin: 0 .75em 0 0"></i>
                Cancel Subscription
            </a>
        @endnotcancelled
        @cancelled
            <a class="item {{ request()->is('*/resume') ? 'active' : '' }}" href="{{ route('account.subscription.resume.index') }}">
                <i class="play circle icon" style="float: left; margin: 0 .75em 0 0"></i>
                Resume Subscription
            </a>
        @endcancelled
        @customer
        <a class="item {{ request()->is('*/invoice') ? 'active' : '' }}" href="{{ route('account.subscription.invoice.index') }}">
            <i class="newspaper outline icon" style="float: left; margin: 0 .75em 0 0"></i>
            Invoices
        </a>
        <a class="item {{ request()->is('*/card') ? 'active' : '' }}" href="{{ route('account.subscription.card.index') }}">
            <i class="credit card icon" style="float: left; margin: 0 .75em 0 0"></i>
            Update Card
        </a>
        @endcustomer
        @teamsubscription
        <a class="item {{ request()->is('*/team') ? 'active' : '' }}" href="{{ route('account.subscription.team.index') }}">
            <i class="users icon" style="float: left; margin: 0 .75em 0 0"></i>
            Manage Team
        </a>
        @endteamsubscription
    @endnotpiggybacksubscription
@endsubscribed
