@extends('account.layouts.default')
@section('account.content')
    <div class="ui segment">
        <form class="ui form" method="POST" action="{{ route('account.password.store') }}">
            @csrf
            <div class="field {{ $errors->has('current_password') ? 'error' : '' }}">
                <label>Current Password</label>
                <div class="ui left icon input">
                    <i class="grey lock icon"></i>
                    <input id="current_password" type="password" placeholder="Current Password"
                           class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                           name="current_password" required autofocus>
                </div>
            </div>
            @if ($errors->has('current_password'))
                <div class="ui error message">
                    <strong>{{ $errors->first('current_password') }}</strong>
                </div>
            @endif

            <div class="field {{ $errors->has('password') ? 'error' : '' }}">
                <label>New Password</label>
                <div class="ui left icon input">
                    <i class="grey lock icon"></i>
                    <input id="password" type="password" placeholder="New Password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           name="password" required autofocus>
                </div>
            </div>
            @if ($errors->has('password'))
                <div class="ui error message">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif

            <div class="field {{ $errors->has('password_confirmation') ? 'error' : '' }}">
                <label>Confirm New Password</label>
                <div class="ui left icon input">
                    <i class="grey lock icon"></i>
                    <input id="password_confirmation" type="password" placeholder="Repeat New Password"
                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                           name="password_confirmation" required autofocus>
                </div>
            </div>
            @if ($errors->has('password_confirmation'))
                <div class="ui error message">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif

            <button type="submit" class="ui blue submit button">Update</button>
        </form>
    </div>
@endsection