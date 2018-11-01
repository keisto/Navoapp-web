@extends('account.layouts.default')
@section('account.content')
    <div class="ui segment">
        <form class="ui form" method="POST" action="{{ route('account.deactivate.store') }}">
            @csrf
            <div class="field {{ $errors->has('password_current') ? 'error' : '' }}">
                <label>Current Password</label>
                <div class="ui left icon input">
                    <i class="grey lock icon"></i>
                    <input id="password_current" type="password" placeholder="Current Password" name="password_current">
                </div>
            </div>
            @if ($errors->has('password_current'))
                <div class="ui error message">
                    <strong>{{ $errors->first('password_current') }}</strong>
                </div>
            @endif
            <button type="submit" class="ui yellow submit button">Deactivate Account</button>
            @notcancelled
                @if (!auth()->user()->hasPiggybackSubscription())
                    <span>This will also cancel your active subscription.</span>
                @endif
            @endnotcancelled
</form>
</div>
@endsection