@extends('layouts.splash')
@section('content')
    <div class="v-center bg-repeat" style="min-height: 100vh">
        <div class="ui center aligned container" style="margin: auto; display: block">
            <div class="ui grid center aligned">
                <div class="thirteen wide mobile ten wide tablet six wide computer column">
                    <img src="{{ asset('images/navo-large.svg') }}" style="width: 120px" class="ui inline image">
                    <form class="ui large form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="ui segment">
                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="grey mail icon"></i>
                                    <input id="email" type="email" placeholder="E-mail Address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="grey lock icon"></i>
                                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                            <div class="field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label>Remember Me?</label>
                                </div>
                            </div>

                            <button type="submit" class="ui fluid large blue submit button">Login</button>

                        </div>
                    </form>
                    <div class="ui olive message">
                        Not registered? <a href="{{ route('register') }}">Sign Up</a>
                    </div>
                    <div class="ui yellow message">
                        Forgot Password? <a class="btn btn-link" href="{{ route('password.request') }}">Reset</a>
                    </div>
                    <div class="ui blue message">
                        <a class="btn btn-link" href="{{ route('activation.resend') }}">Resend Activation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
