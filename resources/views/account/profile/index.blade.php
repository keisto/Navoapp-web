@extends('account.layouts.default')
@section('account.content')
    <form class="ui form" method="POST" action="{{ route('account.profile.store') }}">
        @csrf
            <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                <label>Full Name</label>
                <div class="ui left icon input">
                    <i class="grey user circle outline icon"></i>
                    <input id="name" type="text" placeholder="Full Name"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{ old('name', auth()->user()->name) }}" required autofocus>
                </div>
            </div>
            @if ($errors->has('name'))
                <div class="ui error message">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif

            <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                <label>Email Address</label>
                <div class="ui left icon input">
                    <i class="grey mail outline icon"></i>
                    <input id="email" type="email" placeholder="E-mail Address"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email', auth()->user()->email) }}" required autofocus>
                </div>
                @if ($errors->has('email'))
                    <div class="ui error message">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
            </div>

            <button type="submit" class="ui blue submit button">Update</button>
    </form>
@endsection