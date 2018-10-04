@extends('layouts.splash')
@section('content')
    <div class="v-center bg-repeat" style="min-height: 100vh">
        <div class="ui center aligned container" style="margin: auto; display: block">
            <div class="ui grid center aligned">
                <div class="thirteen wide mobile ten wide tablet six wide computer column">
                    @if (session('status'))
                        <div class="ui green large message">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{--<img src="{{ asset('images/navo-large.svg') }}" style="width: 120px" class="ui inline image">--}}
                    <form class="ui large form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="ui segment">
                            <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                                <div class="ui left icon input">
                                    <i class="grey mail icon"></i>
                                    <input id="email" type="email" placeholder="E-mail Address" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <div class="ui error message">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif

                            <button type="submit" class="ui fluid large blue submit button">Email Reset Link</button>
                        </div>
                    </form>
                    <a href="{{ route('login') }}" class="ui black fluid button" style="margin-top: 12px">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection