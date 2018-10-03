@extends('layouts.splash')
@section('content')
    <div class="v-center bg-repeat" style="min-height: 100vh">
        <div class="ui center aligned container" style="margin: auto; display: block">
            <div class="ui grid center aligned">
                <div class="thirteen wide mobile ten wide tablet six wide computer column">
                    {{--<img src="{{ asset('images/navo-large.svg') }}" style="width: 120px" class="ui inline image">--}}
                    <form class="ui large form" method="POST" action="{{ route('activation.resend.store') }}">
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

                            <button type="submit" class="ui fluid large blue submit button">Resend</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
