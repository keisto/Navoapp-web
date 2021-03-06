@extends('layouts.splash')
@section('content')
    <div class="v-center bg-repeat" style="min-height: 100%;">
        <div class="ui center aligned container" style="margin: auto; display: block;">
            <div class="ui grid center aligned">
                <div class="thirteen wide mobile ten wide tablet six wide computer column">
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
                            </div>
                            @if ($errors->has('password'))
                                <div class="ui error message">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif

                            <div class="field {{ $errors->has('terms') ? 'error' : '' }}">
                                <div class="ui checkbox" style="display: inline-block">
                                    <input type="checkbox" name="terms">
                                    <label style="display: inline-block">I agree</label> to the
                                </div>
                                <span onclick="$('#modal_privacy').modal('show');" style="color: #0d71bb">privacy policy</span>
                                and <span onclick="$('#modal_terms').modal('show');" style="color: #0d71bb;">terms</span>.
                            </div>

                            @if ($errors->has('terms'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('terms') }}</strong>
                                </span>
                            @endif

                            <button type="submit" class="ui fluid large blue submit button">Register</button>
                        </div>
                    </form>

                    {{--<div class="ui icon success message">--}}
                        {{--<i class="large icons">--}}
                            {{--<i class="big notched circle loading icon"></i>--}}
                            {{--<i class="small wrench icon" style="position: absolute; left: 21px;"></i>--}}
                        {{--</i>--}}

                        {{--<div class="content">--}}
                        {{--<div class="header">--}}
                            {{--Currently Beta Testing--}}
                        {{--</div>--}}
                            {{--<p>Contact <a href="mailto:tony@navoapp.io">tony@navoapp.io</a> for any questions.</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

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