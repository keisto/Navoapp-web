@extends('layouts.splash')
@section('content')
    <div class="v-center bg-repeat" style="min-height: 100%;">
        <div class="ui center aligned container" style="margin: auto; display: block;">
            <div class="ui grid center aligned">
                <div class="thirteen wide mobile ten wide tablet six wide computer column">
                    {{--<img src="{{ asset('images/navo-large.svg') }}" style="width: 120px" class="ui inline image">--}}
                    <form class="ui large form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="ui segment">
                            <div class="field">
                                <div class="ui left icon {{ $errors->has('email') ? 'error' : '' }} input">
                                    <i class="grey mail icon"></i>
                                    <input id="email" type="email" placeholder="E-mail Address" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <div class="ui error message">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif

                            <div class="field">
                                <div class="ui left icon action input {{ $errors->has('password') ? 'error' : '' }}">
                                    <i class="grey lock icon"></i>
                                    <input id="password" type="password" name="password" placeholder="Password">
                                    <button type="button" class="ui icon basic button" onclick="myPassword()">
                                        <i class="eye icon"></i>
                                    </button>
                                </div>
                                {{--<div class="ui left icon input{{ $errors->has('password') ? ' error' : '' }}">--}}
                                    {{--<i class="grey lock icon"></i>--}}
                                    {{--<input id="password" type="password" name="password" placeholder="Password">--}}
                                {{--</div>--}}
                            </div>
                            @if ($errors->has('password'))
                                <div class="ui error message">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif

                            {{--<div class="field">--}}
                                {{--<div class="ui left icon input">--}}
                                    {{--<i class="grey lock icon"></i>--}}
                                    {{--<input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation">--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="field {{ $errors->has('terms') ? 'error' : '' }}">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="terms">
                                    <label>I accept the <a>terms of services</a></label>
                                </div>
                            </div>

                            @if ($errors->has('terms'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('terms') }}</strong>
                                </span>
                            @endif

                            <button type="submit" class="ui fluid large blue submit button">Register</button>
                        </div>



                    </form>

                    <div class="ui black inverted message" style="margin-bottom: 20px">
                        Already registered? <a href="{{ route('login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function myPassword(e) {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection