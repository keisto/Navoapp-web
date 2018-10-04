@extends('layouts.splash')
@section('content')
    <div class="v-center bg-repeat" style="min-height: 100vh">
        <div class="ui center aligned container" style="margin: auto; display: block">
            <div class="ui grid center aligned">
                <div class="thirteen wide mobile ten wide tablet six wide computer column">
                    <form class="ui large form" method="POST" action="{{ route('password.request') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="ui segment">
                            <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                                <div class="ui left icon input">
                                    <i class="grey mail icon"></i>
                                    <input id="email" type="email" placeholder="E-mail Address" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <div class="ui error message">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif

                            <div class="field {{ $errors->has('password') ? 'error' : '' }}">
                                <div class="ui left icon input">
                                    <i class="grey lock icon"></i>
                                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <div class="ui error message">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif

                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="grey lock icon"></i>
                                    <input id="assword-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <button type="submit" class="ui fluid large blue submit button">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

